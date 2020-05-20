<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Appointment;
use Illuminate\Http\Request;

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
        $appointment = $this->appointments->find($request->appointment);

        $applicant = Applicant::updateOrCreate($request->except(['_token', 'appointment']));

        $appointment->update(['applicant_id' => $applicant->id]);

        return view('appointments.greeting', compact('appointment'));
    }
}
