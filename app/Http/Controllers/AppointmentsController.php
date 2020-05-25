<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Appointment;
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
        $appointments = $this->appointments->get();

        return view('appointments.index', compact('appointments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'appointment' => 'required',
            'email' => 'email'
        ]);


        $appointment = $this->appointments->find($request->appointment);

        $applicant = Applicant::create($request->only(['name', 'phone', 'appointment', 'email', 'comment']));

        $rs = $this->payment();

        $appointment->update(['applicant_id' => $applicant->id]);

        if ($request->email != null) {
            Mail::send('emails.info', $request->all(), function($message) use ($request) {
                $message->to([$request->email])
                        ->subject('Sikeres online bejelentkezes');
            });
        }

        $request['appointment'] = $appointment->appointment;
        Mail::send('emails.new-applicant', $request->all(), function($message) use ($request) {
            $message->to(['dr.cstibor@freemail.hu'])
                    ->subject('Új online bejelentkezes');
        });

        if (Mail::failures()) {
           return response()->Fail('Hiba');
        }
        else{
            return view('appointments.greeting', compact('appointment'));
         }

    }

    public function payment()
    {
        require_once app_path('Barion/BarionClient.php');
        $myPosKey = "b847cf2ff72c4f5e9768595a988c9cbb";
        $apiVersion = 2;

        // Test environment
        $environment = \BarionEnvironment::Test;
        $BC = new \BarionClient($myPosKey, $apiVersion, $environment);

        $item = new \ItemModel();
        $item->Name = "Online konzultáció";
        $item->Description = "Online konzultáció jelentkezés";
        $item->Quantity = 1;
        $item->Unit = "piece";
        $item->UnitPrice = 12000;
        $item->ItemTotal = 12000;
        $item->SKU = "ITEM-01";

        $trans = new \PaymentTransactionModel();
        $trans->POSTransactionId = "TRANS-01";
        $trans->Payee = "attila.kovacs92@gmail.com";
        $trans->Total = 12000;
        $trans->Currency = \Currency::HUF;
        $trans->Comment = "Test transaction containing the product";
        $trans->AddItem($item);

        $ppr = new \PreparePaymentRequestModel();
        $ppr->GuestCheckout = true;
        $ppr->PaymentType = \PaymentType::Immediate;
        $ppr->FundingSources = array(\FundingSourceType::All);
        $ppr->PaymentRequestId = "PAYMENT-01";
        $ppr->PayerHint = "user@example.com";
        $ppr->Locale = \UILocale::HU;
        $ppr->OrderNumber = "ORDER-0001";
        $ppr->Currency = \Currency::HUF;
        $ppr->RedirectUrl = "http://barion.site/";
        $ppr->CallbackUrl = "https://demo.csosziendoszkopia.hu/callback";
        $ppr->AddTransaction($trans);

        $myPayment = $BC->PreparePayment($ppr);
        //$response = Http::get($myPayment->PaymentRedirectUrl);
        return redirect($myPayment->PaymentRedirectUrl);
    }
}
