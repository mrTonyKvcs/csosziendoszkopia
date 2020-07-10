<?php

namespace App\Http\Controllers\Admin;

use App\Appointment;
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

        return view('admin.appointments.index', compact('appointments'));
    }

    public function create()
    {
        return view('admin.appointments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment' => 'required'
        ]);

        $request['user_id'] = Auth::id();

        Appointment::create($request->all());

        return back();
    }

    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        $appointment->delete();

        return back();
    }
}
