<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Band;
use App\Models\Genero;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function Sodium\add;

class BandController extends Controller
{
    public function viewBand($idBand){
        $band = $this->getDetailsBand($idBand);
        $allAlbumsOfBand = $this->getAlbumsOfBand($idBand);
        $randomBarMusics = IndexController::getRandomMusics();
/*
        $allMusicsOfBand = Arr::where($allMusics, function($value) use ($id) {
            return $value['band_id'] == $id;
        });*/
        $allMusicsOfBand = Music::where('band_id', $idBand)->paginate(10);
        return view('musics.index_band', compact('band', 'allAlbumsOfBand', 'allMusicsOfBand', 'randomBarMusics'));
    }

    public static function getAlbumsOfBand($idBand){
        $albumsOfBand = Album::where('band_id', $idBand)->get();
        return $albumsOfBand;
    }
    private function getDetailsBand($id){
        $band = Band::where('id', $id)->get()->first();
        $countryBand = DB::table('paises')->where('id', $band->pais_id)->first()->name;
        $band = Arr::add($band, 'band_country', $countryBand);
        $band = Arr::add($band, 'band_genres', $this->getGenresOfBand($id));
        return $band;
    }

    /**
     * @param $id Id of The band that we want to search for the genres
     * @return array With all the genres names
     */
    public static function getGenresOfBand($id){
        $genresBand = DB::table('bandgeneros')->where('band_id', $id)->get();
        $genres = [];
        foreach ($genresBand as $genre) {
            $newArray = collect(['genre_id' => $genre->genero_id, 'genre_name' => Genero::where('id', $genre->genero_id)->first()->name]);
            array_push($genres, $newArray);
        }
        return $genres;
    }
    public function createBandView(){
        $paises = DB::table("paises")->get()->all();
        $genres = Genero::get()->all();
        return view('musics.create_band', compact('paises', 'genres'));
    }
    public function storeBand(Request $request){
        $request->validate([
            'band_name' => 'required|unique:bands,name',
            'band_released_at' => 'date|nullable',
            'country_band' => 'exists:paises,id',
            'inputGenres' => 'present|array',
            'inputGenres.*'=> 'exists:generos,id',
            'band_image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
        $photo = null;
        if($request->hasFile('band_image')) {
            $photo = Storage::putFile('user/photos', $request->band_image);
        }
        $newBand = Band::insertGetId([
            'name'=>$request->band_name,
            'founded_at'=>$request->band_released_at,
            'photo'=> $photo ? $photo : 'music/musicCoverDefault.png',
            'pais_id'=>$request->country_band,
        ]);

        foreach($request->inputGenres as $genre){
            DB::table('bandgeneros')->insert([
                'band_id' => $newBand,
                'genero_id' => $genre
            ]);
        }
        return route('home');
    }
}
