<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MedicalExamination;
use Illuminate\Http\Request;

class MedicalExaminationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $medicalExaminations = MedicalExamination::all();

        return view('admin.medical-examinations.index', compact('medicalExaminations'));
    }

    public function show($id)
    {
        $medicalExamination = MedicalExamination::find($id);

        return view('admin.medical-examinations.show', compact('medicalExamination'));
    }

    public function update(Request $request, $id)
    {
        $medicalExamination = MedicalExamination::find($id);

        $medicalExamination->update($request->only(['name', 'is_active']));

        return back();
    }

    public function destroy($id)
    {
        $medicalExamination = MedicalExamination::find($id);

        $medicalExamination->delete();

        return back();
    }
}
