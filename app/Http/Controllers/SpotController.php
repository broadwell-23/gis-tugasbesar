<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spot;
use Image;

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

        if($request->hasFile('foto')){
          $gambar = $request->file('foto');
          $filename = time() . '.' . $gambar->getClientOriginalExtension();
          $path = public_path('img/foto/' . $filename);

          Image::make($gambar)->resize(1366, null, function ($constraint) {
                                $constraint->aspectRatio();})
                              ->save($path);

          $spot->foto = $filename;
        }

      $spot->virtual_tour = $request->virtual_tour;
      $spot->save();

    	return redirect()->action('SpotController@index');
    }

    public function update(Request $request){
      $this->validate($request, [
        'foto' => 'required',
      ]);

    	$spot = Spot::find($request->id);
      $data = $request->all();
    	$spot->nama_cafe = $request->nama_cafe;
      $spot->titik = $request->titik;
      $spot->alamat = $request->alamat;
      $spot->no_hp = $request->no_hp;

        if($request->hasFile('foto')){
          $gambar = $request->file('foto');
          $filename = time() . '.' . $gambar->getClientOriginalExtension();
          $path = public_path('img/foto/' . $filename);

          Image::make($gambar)->resize(1366, null, function ($constraint) {
                                $constraint->aspectRatio();})
                              ->save($path);

          $spot->foto = $filename;
        }

      $spot->virtual_tour = $request->virtual_tour;
      $spot->save();


    	return redirect()->action('SpotController@index');
    }

    public function destroy(Request $request){

    	Spot::find($request->id)->delete();

    	return redirect()->action('SpotController@index');
    }
}
