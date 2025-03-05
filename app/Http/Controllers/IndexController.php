<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

    public function vision()
    {
        return view('vision');
    }

    public function mission()
    {
        return view('mission');
    }


    public function future_scenario()
    {
        return view('future-scenario');
    }

    public function members()
    {
        return view('members');
    }

    public function rules()
    {
        return view('rules');
    }


    public function services_and_standards()
    {
        return view('services-and-standards');
    }

    public function complaints()
    {
        return view('complaints');
    }

    public function contact()
    {
        return view('contact');
    }

    public function login()
    {
        return view('login');
    }

    public function validateCaptcha(Request $request)
    {
        $request->validate([
            'captcha' => 'required|captcha',
        ]);

        return back()->with('success', 'CAPTCHA matched successfully!');
    }
}
