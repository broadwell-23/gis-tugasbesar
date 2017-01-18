<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spot;

class SpotController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){

    	$spots = Spot::all();

    	return view('spot', compact('spots'));
    }

    public function store(Request $request){

    	$spot = new Spot;
        $spot->nama_cafe = $request->nama_cafe;
        $spot->titik = $request->titik;
        $spot->alamat = $request->alamat;
        $spot->no_hp = $request->no_hp;
        $spot->foto = $request->foto;
        $spot->virtual_tour = $request->virtual_tour;
        $spot->save();

    	return redirect()->action('SpotController@index');
    }

    public function update(Request $request){

    	$spot = Spot::find($request->id);
    	$spot->nama_cafe = $request->nama_cafe;
        $spot->titik = $request->titik;
        $spot->alamat = $request->alamat;
        $spot->no_hp = $request->no_hp;
        $spot->foto = $request->foto;
        $spot->virtual_tour = $request->virtual_tour;
        $spot->save();

    	return redirect()->action('SpotController@index');
    }

    public function destroy(Request $request){

    	Spot::find($request->id)->delete();

    	return redirect()->action('SpotController@index');
    }
}
