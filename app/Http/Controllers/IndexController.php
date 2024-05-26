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

class IndexController
{
    public function getHomeView()
    {
        $this->getSixMixes();
        $sixBands = Band::getRandomSixBands();
        $sixAlbums = Album::getSixRandomAlbums();
        $randomBarMusics = Music::getRandomMusics();
        $mixes = $this->getSixMixes();
        return view('home', compact('sixAlbums', 'sixBands', 'randomBarMusics', 'mixes'));
    }

    /**
     * Method that returns one Array with 6 random genres on the database
     * @return array with 6 elements which each element will contain ['genero_id','name',''photo']
     */
    private function getSixMixes()
    {
        $genres = Arr::take(DB::table('bandgeneros')->distinct()->get('genero_id')->all(), 6);
        foreach ($genres as $genre) {
            $genre->name = DB::table('generos')->where('id', $genre->genero_id)->first()->name;
            $bands = DB::table("bandgeneros")->where('genero_id', $genre->genero_id)->distinct()->get('band_id')->all();
            $genre->photo = Band::where('id', Arr::random($bands)->band_id)->first()->photo;
        }
        return $genres;
    }

    public function getFallBack()
    {
        return view('Errors.fallback');
    }

    public function getAllitems($name)
    {
        $title = "";
        $type = "";
        $imgLink = asset("");
        $items = null;

        if ($name == "bands") {
            $title = "band";
            $type = "bands";
            $imgLink = asset('files/img/banners/bannerBands.jpg');
            $items = Band::paginate(24);
        } else if ($name == "musics") {
            $title = "music";
            $type = "musics";
            $imgLink = asset('files/img/banners/bannerMusics.jpg');
            $search = request()->query('search') ? request()->query('search') : null;
            if ($search) {
                $imgLink = asset('files/img/banners/bannerMusics.jpg');
                $items = Music::where('name', 'like', '%' . $search . '%')->get();
            } else {
                $musicModel = new Music();
                $items = $musicModel->getAllMusics(24);
            }

        } else if ($name == "albums") {
            $title = "album";
            $type = "albums";
            $imgLink = asset('files/img/banners/bannerAlbums.jpg');
            $items = Album::paginate(24);
        } else {
            $genero = DB::table("generos")->where('name', $name)->first();
            if ($genero) {
                $generoid = Db::table('generos')->where('name', $name)->first()->id;
                $music = new Music();
                $title = "music";
                $type = 'Mix ' . $name;
                $imgLink = asset('files/img/banners/bannerMusics.jpg');
                $items = Arr::take(Arr::shuffle($music->getAllMusicsByGenre($generoid)->all()), 20);
            } else {
                return view('Errors.fallback');
            }
        }
        $randomBarMusics = Music::getRandomMusics();
        return view('pages.all_items', compact('title', 'type', 'imgLink', 'items', 'randomBarMusics'));
    }

}
