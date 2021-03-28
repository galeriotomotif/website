<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteMapController extends Controller
{

    public function index(Request $request){

    }
    public function show(Request $request){
        dd($request->path
    );
    }
}
