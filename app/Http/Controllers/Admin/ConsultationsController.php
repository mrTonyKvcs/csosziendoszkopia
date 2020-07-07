<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Consultation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsultationsController extends Controller
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

    public function index()
    {
        if (auth()->user()->role == 'doctor') {
            $consultations = auth()->user()->consultations()->with('user')->get();
            $doctor = [];
        } else {
            $consultations = Consultation::with('user')->get();
        }

        return view('admin.consultations.index', compact('consultations'));
    }

    public function create()
    {
        $doctors = User::where('role', 'doctor')->get();

        return view('admin.consultations.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'day' => 'required',
            'open' => 'required',
            'close' => 'required',
        ]);

        Consultation::create($request->only(['user_id', 'day', 'open', 'close']));

        return back();
    }

    public function destroy($id)
    {
        $consultations = Consultation::find($id);

        $consultations->delete();

        return back();
    }
}
