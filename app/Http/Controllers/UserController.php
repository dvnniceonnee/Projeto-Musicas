<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function indexUser(){
        $randomBarMusics = IndexController::getRandomMusics();
        return view('user.profile', compact('randomBarMusics'));
    }

    public function dashboardView(){
        $allBands = $this->getAllBands();
        dd($allBands);
        $allAlbums = ALbum::all()->get();
        $allMusics = Music::all()->get();
        return view('user.dashboard_admin', compact('allBands', 'allAlbums', 'allMusics'));
    }

    private function getAllBands(){
        $allBands = Band::all()->get();
        foreach ($allBands as $band) {
            $pais = DB::table('paises')->where('id', $band->pais_id)->get();
            Arr::add($band, 'pais_name', $pais->name);
        }
        return $allBands;
    }
    public function registerUser(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::insert([
            'name' => $request->first_name .' '. $request->last_name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('message', 'Registo efetuado com sucesso!');
    }
}
