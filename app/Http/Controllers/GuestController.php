<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index(Request $request)
    {
        $routeName = $request->path();
        switch ($routeName) {
            case 'beranda':
                return view('guest.beranda');
            case 'about':
                return view('guest.about');
            case 'faq':
                return view('guest.faq');
            case 'contact':
                return view('guest.contact');
            default:
                return redirect('/beranda');
        }
    }
}
