<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    protected $prices;

    public function __construct()
    {
        $this->prices = config('site.services');
    }

    public function index()
    {
        $services = collect(config('site.services'))->where('section', true);

        $doctors = config('site.doctors');

        $prices = $this->prices;

        return view('pages.index', compact('doctors', 'services', 'prices'));
    }

    public function doctor($slug)
    {
        $doctor = collect(config('site.doctors'))->where('slug', $slug)->first();

        return view('pages.doctors', compact('doctor'));
    }

    public function prices()
    {
        $prices = $this->prices;

        return view('pages.prices', compact('prices'));
    }
}
