<?php

namespace App\Http\Controllers;

use App\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
        $allAppointments = Appointment::where('user_id', Auth::id())
            ->count();

        $reservedAppointments = Appointment::where('user_id', Auth::id())
            ->whereNotNull('applicant_id')
            ->orderBy('appointment', 'desc')
            ->get();

        $freeAppointment = Appointment::where('user_id', Auth::id())
            ->whereNull('applicant_id')
            ->count();

        return view('home', compact('allAppointments', 'freeAppointment', 'reservedAppointments'));
    }
}
