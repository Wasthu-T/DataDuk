<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        return view('admin.dashboard.data');
    }
    public function index_domisili(){
        return view('admin.dashboard.datapindah');
    }

}
