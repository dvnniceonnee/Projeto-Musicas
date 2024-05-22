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
        $this->getSixMixes();
        $sixBands = $this->getSixBands();
        $sixAlbums = $this->getSixAlbums();
        $randomBarMusics = $this->getRandomMusics();
        $mixes = $this->getSixMixes();
        return view('home', compact('sixAlbums', 'sixBands', 'randomBarMusics', 'mixes'));
    }

    private function getSixMixes()
    {
        $genres = Arr::take(DB::table('bandgeneros')->distinct()->get('genero_id')->all(), 6);
        foreach ($genres as $genre) {
            $genre->name = DB::table('generos')->where('id', $genre->genero_id)->first()->name;
            $bands = DB::table("bandgeneros")->where('genero_id', $genre->genero_id)->distinct()->get('band_id')->all();
            $genre->photo = Band::where('id', Arr::random($bands)->band_id)->first()->photo;
//            $genre->photo = Band::where('id', )->first()->photo;
//            $bands = DB::table('bandgeneros')->where('genero_id', $genre->genero_id)->distinct()->get('band_id')->all();
//            foreach ($bands as $band) {
//                $band->name = Band::where('id', $band->band_id)->first()->name;
//            }
//            $genre->bands = $bands;
        }
        return $genres;
    }

    /**
     * Method that Returns 15 random Musics with a extra field called 'band_name'
     * @return array With 15 random Musics
     */
    public static function getRandomMusics()
    {
        $randomMusics = Arr::take(Arr::shuffle(Music::get()->all()), 15);
        foreach ($randomMusics as $music) {
            $bandName = Band::where('id', $music->band_id)->first();
            Arr::add($music, 'band_name', $bandName->name);
        }
        return $randomMusics;
    }

    /**
     * Method to return 6 random bands and for each band the method will add a array of the genres that the band has
     * @return array With 6 bands
     */
    private function getSixBands()
    {
        $sixBands = Arr::take(Arr::shuffle(Band::get()->all()), 6);
        foreach ($sixBands as $band) {
            $arrayGeneros = DB::table('bandgeneros')->where('band_id', $band->id)->select('genero_id')->get();
            $array = [];
            foreach ($arrayGeneros as $genero) {
                $array[$genero->genero_id] = Genero::where('id', $genero->genero_id)->get()->first()->name;
            }
            Arr::add($band, 'genres', $array);
        }
        return $sixBands;
    }

    /**
     * Method that returns 6 random Albums and add to each one of them a field with the name
     * @return array
     */
    private function getSixAlbums()
    {
        $sixAlbums = Arr::take(Arr::shuffle(Album::get()->all()), 6);

        foreach ($sixAlbums as $album) {
            $bandName = Band::where('id', $album->band_id)->get()->first()->name;
            Arr::add($album, 'band_name', $bandName);
        }
        return $sixAlbums;
    }

    public function getFallBack()
    {
        return view('Errors.fallback');
    }

    public function getAllitems($name)
    {
        $title = "";
        $type = "";
        $musicBar = false;
        $imgLink = asset("");
        $items = null;
        if ($name == "bands") {
            $title = "band";
            $type = "bands";
            $musicBar = true;
            $imgLink = asset('files/img/banners/bannerBands.jpg');
            $items = Band::get()->all();
        } else if ($name == "musics") {
            $title = "music";
            $type = "pages";
            $musicBar = true;
            $imgLink = asset('files/img/banners/bannerMusics.jpg');
            $items = Music::get()->all();
        } else if ($name == "albums") {
            $title = "album";
            $type = "albums";
            $musicBar = true;
            $imgLink = asset('files/img/banners/bannerAlbums.jpg');
            $items = Album::get()->all();
        } else {
            $generos = DB::table('generos')->get()->all();
            foreach ($generos as $genero) {
                if($name == $genero->name){
                    $allbands = DB::table('bandgeneros')->where('genero_id', $genero->id)->get('band_id');
                    dd($allbands);
                }
            }
            return view('Errors.fallback');
        }
        $randomBarMusics = IndexController::getRandomMusics();
        return view('pages.all_items', compact('title', 'type', 'musicBar', 'imgLink', 'items', 'randomBarMusics'));
    }

}
