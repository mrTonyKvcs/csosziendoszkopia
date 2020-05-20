<?php

namespace App\Http\Controllers;

use App\Applicant;
use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        ]);

        $appointment = $this->appointments->find($request->appointment);

        $applicant = Applicant::updateOrCreate($request->except(['_token', 'appointment']));

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

        return view('appointments.greeting', compact('appointment'));
    }
}
