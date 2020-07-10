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
        $authUserId = Auth::id();

        $appointments = Appointment::whereHas('consultation', function($q) {
            $q->where('user_id', Auth::id());
        })
        ->get();

        $allAppointments = $appointments->count();

        return view('home', compact('allAppointments', 'appointments'));
    }
}
