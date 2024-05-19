<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Band;
use App\Models\Genero;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use function Sodium\add;

class IndexController extends Controller
{
    public function getHomeView()
    {
        $sixBands = $this->getSixBands();
        $sixAlbums = $this->getSixAlbums();
        $randomBarMusics = $this->getRandomMusics();
        return view('home', compact('sixAlbums', 'sixBands', 'randomBarMusics'));
    }

    public static function getRandomMusics(){
        $randomMusics = Arr::take(Arr::shuffle(Music::get()->all()), 15);
        foreach ($randomMusics as $music){
            $bandName = Band::where('id', $music->band_id)->first();
            Arr::add($music, 'band_name', $bandName->name);
        }
        return $randomMusics;

    }
    private function getSixBands(){
        $sixBands = Arr::take(Arr::shuffle(Band::get()->all()), 6);
        foreach ($sixBands as $band){
            $arrayGeneros = DB::table('bandgeneros')->where('band_id', $band->id)->select('genero_id')->get();
            $array = [];
            foreach ($arrayGeneros as $genero){
                $array[$genero->genero_id] = Genero::where('id', $genero->genero_id)->get()->first()->name;
            }
            $band = Arr::add($band, 'genres', $array);
        }
        return $sixBands;
    }

    private function getSixAlbums(){
        $sixAlbums = Arr::take(Arr::shuffle(Album::get()->all()), 6);

        foreach ($sixAlbums as $album){
            $arrayGeneros = Band::where('id', $album->band_id)->get('name')->first();
            Arr::add($album, 'band_name', $arrayGeneros->name);
        }
        return $sixAlbums;
    }

    public function getFallBack()
    {
        return view('Errors.fallback');
    }

    public function getPage($id)
    {
        $title = "";
        $type = "";
        $musicBar = false;
        $imgLink = asset("");
        $items = null;
        if ($id == "bands") {
            $title = "band";
            $type = "bands";
            $musicBar = true;
            $imgLink = asset('files/img/banners/bannerBands.jpg');
            $items = Band::get()->all();
        } else if ($id == "musics") {
            $title = "music";
            $type = "musics";
            $musicBar = true;
            $imgLink = asset('files/img/banners/bannerMusics.jpg');
            $items = Music::get()->all();
        } else if ($id == "albums") {
            $title = "album";
            $type = "albums";
            $musicBar = true;
            $imgLink = asset('files/img/banners/bannerAlbums.jpg');
            $items = Album::get()->all();
        }else{
            return view('Errors.fallback');
        }
        $randomBarMusics = IndexController::getRandomMusics();
        return view('musics.all_items', compact('title', 'type', 'musicBar', 'imgLink', 'items', 'randomBarMusics'));
    }

}
