<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $services = config('site.services');

        return view('pages.index', compact('services'));
    }
}
