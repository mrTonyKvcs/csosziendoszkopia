<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class DoctorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $doctors = User::doctors()
            ->get();

        return view('admin.doctors.index', compact('doctors'));
    }

    public function destroy($id)
    {
        $doctor = User::find($id);

        $doctor->delete();

        return back();
    }
}
