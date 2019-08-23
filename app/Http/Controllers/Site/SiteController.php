<?php

//namespace App\Http\Controllers;
namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    //
    public function index(){
        //exibe a view de resouces/view/site/home/index.blade.php
        return view('site.home.index');
    }
}
