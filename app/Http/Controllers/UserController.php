<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Band;
use App\Models\Music;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function indexUser(){
        $randomBarMusics = IndexController::getRandomMusics();
        return view('user.profile', compact('randomBarMusics'));
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
