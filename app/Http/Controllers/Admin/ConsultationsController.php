<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Office;
use App\Consultation;
use App\Exports\AppointmentsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

        $offices = Office::all();

        return view('admin.consultations.create', compact('doctors', 'offices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'day' => 'required',
            'open' => 'required',
            'close' => 'required',
            'office_id' => 'required',
            'is_digital' => 'required'
        ]);

        Consultation::create($request->only(['user_id', 'day', 'open', 'close', 'office_id', 'is_digital']));

        return back();
    }

    public function destroy($id)
    {
        $consultations = Consultation::find($id);

        $consultations->delete();

        return back();
    }

    public function export(Consultation $consultation) 
    {
        $appointments = $consultation->appointments;

        $export = new AppointmentsExport([$appointments]);
        $office = \Str::slug($consultation->office->name);

        return Excel::download($export, $office . '-' . $consultation->day . '.xlsx');
    }
}
