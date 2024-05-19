<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Band;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    public function indexMusic($idmusic){
        $randomBarMusics = IndexController::getRandomMusics();
        $music = $this->getMusic($idmusic);
        $music = Arr::add($music, 'band_name', Band::where('id', $music->band_id)->first()->name);
        $music = Arr::add($music, 'album_name', Album::where('id', $music->album_id)->first()->name);
        $randomMusics = Arr::take(Arr::shuffle(Music::where('band_id', $music->band_id)->get()->all()), 15);
        $this->getSimilarMusics($music->band_id);
        return view('musics.index_music', compact('randomBarMusics', 'music', 'randomMusics'));
    }

    private function getSimilarMusics($bandId){
        $genres[] = BandController::getGenresOfBand($bandId);
        dd($genres);
        $musics[] = [];
        $bandsSameGenres = DB::table('bandgeneros')->whereIn('genero_id',[$genres])->pluck('id');
        dd($bandsSameGenres);
        dd($bandsSameGenres);
        for($i = 0; $i < 15; $i++){
//            Arr::add($bandsSameGenres, "band_".$i)
        }

    }

    private function getMusic($idmusic){
        $music = Music::where('id', $idmusic)->first();
        return $music;
    }
    public function createMusicView(){
      $albums = Album::where('band_id',1 )->get()->all();
      return view('musics.create_music', compact('albums'));
    }

    public function storeMusic(Request $request){
        $band_id = -1;
        if($request->album_id != null){
            $band_id = Album::where('id', $request->album_id)->get()->first()->band_id;
        }
        $request->validate([
            'music_name' => 'required|unique:musics,name',
            'music_length' => 'numeric|required',
            'music_image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'band_id'=> "integer|size:$band_id"
        ]);
        $photo = null;
        if($request->hasFile('music_image')) {
            $photo = Storage::putFile('music/', $request->band_image);
        }
        $newMusic = Music::insert([
            'name'=>$request->music_name,
            'photo'=> $photo ? $photo : 'music/musicCoverDefault.png',
            'band_id'=>$request->band_id,
            'album_id'=>$request->album_id
        ]);

    }
}
