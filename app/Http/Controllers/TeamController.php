<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Team;
use Image;

class TeamController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $teams = Team::all();
        return view('team', compact('teams'));
    }
    public function update(Request $request)
    {
    	$team = Team::find($request->id);
    	$team->nama = $request->nama;
      $team->nim = $request->nim;
        if($request->hasFile('foto')){
          $gambar = $request->file('foto');
          $filename = time() . '.' . $gambar->getClientOriginalExtension();
          $path = public_path('img/team/' . $filename);

          Image::make($gambar)->resize(1366, null, function ($constraint) {
                                $constraint->aspectRatio();})
                              ->save($path);

          $team->foto = $filename;
        }
      $team->save();

    	return redirect()->action('TeamController@index');
    }

    public function destroy(Request $request)
    {
    	Team::find($request->id)->delete();

    	return redirect()->action('TeamController@index');
    }
}
