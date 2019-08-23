<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //função inicial para exibir o home (dashboard)
    public function index(){
        return view('admin.home.index');
    }
}
