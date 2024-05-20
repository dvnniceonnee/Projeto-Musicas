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
        $countryBand = DB::table('countries')->where('id', $band->country_id)->first()->name;
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
        $paises = DB::table("countries")->get()->all();
        $randomBarMusics = IndexController::getRandomMusics();
        $genres = Genero::get()->all();
        return view('musics.create_band', compact('paises', 'genres', 'randomBarMusics'));
    }
    public function storeBand(Request $request){
        $request->validate([
            'band_name' => 'required|unique:bands,name',
            'band_released_at' => 'date|nullable',
            'country_band' => 'exists:countries,id',
            'inputGenres' => 'present|array',
            'inputGenres.*'=> 'exists:generos,id',
            'photo'=> 'max:10000',
        ]);
        if($request->hasFile('photo')) {
            $photo = Storage::putFile('bands/', $request->photo);
            $newBand = Band::insertGetId([
                'name'=>$request->band_name,
                'founded_at'=>$request->band_released_at,
                'photo'=> $photo,
                'country_id'=>$request->country_band,
            ]);

        }
        else{
            $newBand = Band::insertGetId([
                'name'=>$request->band_name,
                'founded_at'=>$request->band_released_at,
                'photo'=> 'music/musicCoverDefault.png',
                'country_id'=>$request->country_band,
            ]);
        }

        foreach($request->inputGenres as $genre){
            DB::table('bandgeneros')->insert([
                'band_id' => $newBand,
                'genero_id' => $genre
            ]);
        }
        return redirect()->route('user_dashboard');
    }

    public function editband(Request $request){
        $request->validate([
            'inputBandName' => 'unique:bands,name|string|max:255',
            'inputBandReleasedAt' => 'date',
        ])
    }

    public function editBandView($bandId){
        $randomBarMusics = IndexController::getRandomMusics();
        $band =  Band::where('id', $bandId)->get()->first();
        return view('musics.edit_band', compact('band', 'randomBarMusics'));

    }
    public function deleteBand($bandId){
        Band::where('id', $bandId)->delete();
        return redirect()->route('user_dashboard');
    }
}
