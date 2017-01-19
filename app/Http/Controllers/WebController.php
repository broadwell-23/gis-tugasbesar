<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spot;

class WebController extends Controller
{
    public function index(){

    	$spots = Spot::all();

    	return view('web', compact('spots'));
    }
}
