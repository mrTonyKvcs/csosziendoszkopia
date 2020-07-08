<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Applicant;
use App\Appointment;
use App\MedicalExamination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class AppointmentsController extends Controller
{
    private $appointments;

    public function __construct()
    {
        $this->appointments = Appointment::where('applicant_id', null);
    }

    public function index()
    {
        $medicalExaminations = MedicalExamination::with('doctors')->get();
        //$appointments = $this->appointments->get();

        return view('appointments.index', compact('medicalExaminations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'email',
            'consultation' => 'required',
            'medical_examination' => 'required',
            'appointment_time' => 'required'
        ]);

        $price = \DB::table('doctor_medical_examination')
            ->where('user_id', $request->doctor)
            ->where('medical_examination_id', $request->medical_examination)
            ->first()
            ->price;

        $appointmentTime = explode(',', $request->appointment_time);

        $applicant = Applicant::create($request->only(['name', 'phone', 'appointment', 'email', 'comment']));

        $appointment = Appointment::create([
            'consultation_id' => $request->consultation,
            'medical_examination_id' => $request->medical_examination,
            'applicant_id' => $applicant->id,
            'start_at' => $appointmentTime[0],
            'end_at' => $appointmentTime[1],
        ]);

        $rs = $this->payment($applicant, $appointment, $price);
    }

    public function payment($applicant, $appointment, $price)
    {
        require_once app_path('Barion/BarionClient.php');
        $myPosKey = "b847cf2ff72c4f5e9768595a988c9cbb";
        $apiVersion = 2;

        // Test environment
        $environment = \BarionEnvironment::Test;
        $BC = new \BarionClient($myPosKey, $apiVersion, $environment);

        $item = new \ItemModel();
        $item->Name = $appointment->medicalExamination->name;
        $item->Description = $appointment->medicalExamination->name . " jelentkezés";
        $item->Quantity = 1;
        $item->Unit = "db";
        $item->UnitPrice = $price;
        $item->ItemTotal = $price;
        $item->SKU = "ITEM-01";

        $trans = new \PaymentTransactionModel();
        $trans->POSTransactionId = Uuid::uuid4()->toString();
        $trans->Payee = "attila.kovacs92@gmail.com";
        $trans->Total = $price;
        $trans->Currency = \Currency::HUF;
        $trans->Comment = "Test transaction containing the product";
        $trans->AddItem($item);

        $ppr = new \PreparePaymentRequestModel();
        $ppr->GuestCheckout = true;
        $ppr->PaymentType = \PaymentType::Immediate;
        $ppr->FundingSources = array(\FundingSourceType::All);
        $ppr->PaymentRequestId = Uuid::uuid4()->toString();
        $ppr->PayerHint = $applicant->email;
        $ppr->Locale = \UILocale::HU;
        $ppr->OrderNumber = str_pad('0', 6, $applicant->id, STR_PAD_LEFT);
        $ppr->Currency = \Currency::HUF;
        $ppr->RedirectUrl = "https://demo.csosziendoszkopia.hu/online-bejelentkezes-befejezese?appointment_id=" . $appointment->id;
        $ppr->CallbackUrl = "https://demo.csosziendoszkopia.hu/api/callback?applicant_id=" . $applicant->id;
        $ppr->AddTransaction($trans);

        $myPayment = $BC->PreparePayment($ppr);

        header('Location: ' . $myPayment->PaymentRedirectUrl);
        exit;
    }

    public function greeting(Request $request)
    {
        $applicant = Applicant::where('payment_id', $request->paymentId)
            ->first();

        $appointment = Appointment::find($request->appointment_id);

        if ($applicant) {

            $applicant->appointment = $appointment->appointment;

            if ($request->email != null) {
                Mail::send('emails.info', $applicant->toArray(), function($message) use ($request) {
                    $message->to([$request->email])
                        ->subject('Sikeres online bejelentkezes');
                });
            }

            Mail::send('emails.new-applicant', $applicant->toArray(), function($message) use ($appointment) {
                $message->to([$appointment->consultation->user->email])
                    ->subject('Új online bejelentkezes');
            });

            if (Mail::failures()) {
                return response()->Fail('Hiba');
            }
            else{
                return view('appointments.greeting', compact('appointment'));
            }
        } else {
            $medicalExaminations = MedicalExamination::with('doctors')->get();

            return view('appointments.index', compact('medicalExaminations'))->with('error', 'Sikertelen fizetes');
        }
    }
}
