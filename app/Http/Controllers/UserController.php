<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Band;
use App\Models\Music;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends User
{
    public function indexUser(){
        $userFavourites = DB::table('userfavourites')->where('user_id', Auth::user()->id)->get();
        foreach($userFavourites as $userFavourite){
            $music = Music::where('id', $userFavourite->music_id)->first();
            $musicDetails = MusicController::getMusicDetails($music);
            $userFavourite->band_name = $musicDetails->band_name;
            $userFavourite->music_name = $musicDetails->name;
            $userFavourite->photo = $music->photo;
        }
        $randomBarMusics = Music::getRandomMusics();
        return view('user.profile', compact('randomBarMusics', 'userFavourites'));
    }


    public function registerUser(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user=User::insertGetId([
            'name' => $request->first_name .' '. $request->last_name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);
        $user = User::where('id', $user)->first();
        event(new Registered($user));
        return redirect()->route('login')->with('message', 'Registo efetuado com sucesso!');
    }

    public function updateUser(Request $request){
        $photo = null;
        $request->validate([
            'user_name' => 'string|max:255',
        ]);
        if($request->hasFile('user_photo'))
        {
            if(Auth::user()->photo != 'user/photos/profilePhoto.webp'){
                Storage::delete(Auth::user()->photo);
            }
            $photo = Storage::putFile('user/photos/', $request->user_photo);
            User::where('id', Auth::user()->id)->update([
                'name' => $request->user_name,
                'photo' => $photo
            ]);
        }
        else{
            User::where('id', Auth::user()->id)->update([
                'name' => $request->user_name
            ]);
        }
        return redirect()->back();
    }

    public function addToFavourites($idMusic)
    {
        $favoritos = DB::table('userfavourites')->where('user_id', Auth::id())->get();
        if ($favoritos->contains('music_id', $idMusic)) {
            DB::table('userfavourites')->where(['user_id' => Auth::user()->id, 'music_id' => $idMusic])->delete();
        } else {
            DB::table('userfavourites')->insert([
                'music_id' => $idMusic,
                'user_id' => Auth::user()->id,
            ]);
        }
        return redirect()->back();
    }
}
