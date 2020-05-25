<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $services = config('site.services');

        $doctors = config('site.doctors');

        return view('pages.index', compact('doctors', 'services'));
    }

    public function doctor($slug)
    {
        $doctor = collect(config('site.doctors'))->where('slug', $slug)->first();

        return view('pages.doctors', compact('doctor'));
    }
}
