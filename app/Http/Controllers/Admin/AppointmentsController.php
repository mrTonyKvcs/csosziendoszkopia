<?php

namespace App\Http\Controllers\Admin;

use App\Applicant;
use App\Appointment;
use App\MedicalExamination;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $appointments = Appointment::whereHas('consultation', function($q) {
                $q->where('user_id', Auth::id());
            })
            ->get();

        if (Auth::user()->role == 'super-admin') {
            $appointments = Appointment::all();
        }

        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $medicalExaminations = MedicalExamination::
            isActive()
            ->with('doctors')->get();

        return view('admin.appointments.create', compact('medicalExaminations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'consultation' => 'required',
            'medical_examination' => 'required',
            'appointment_time' => 'required',
            'zip' => 'required',
            'city' => 'required',
            'street' => 'required',
            'social_security_number' => 'required'
        ]);

        $appointmentTime = explode(',', $request->appointment_time);

        $applicant = Applicant::create($request->only(['name', 'phone', 'appointment', 'email', 'comment', 'zip', 'city', 'street', 'social_security_number']));

        $appointment = Appointment::create([
            'consultation_id' => $request->consultation,
            'medical_examination_id' => $request->medical_examination,
            'applicant_id' => $applicant->id,
            'start_at' => $appointmentTime[0],
            'end_at' => $appointmentTime[1],
        ]);

        return back();
    }

    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        $appointment->delete();

        return back();
    }

    public function details($id)
    {
        $applicant = Applicant::find($id);

        return view('admin.appointments.details', compact('applicant'));
    }
}
