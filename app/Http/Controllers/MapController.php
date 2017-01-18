<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spot;

class MapController extends Controller
{
    public function index()
    {
        $spots = Spot::all();

        return view('map', compact('spots'));
    }
}
