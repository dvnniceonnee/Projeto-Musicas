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

class BandController
{
    public function viewBand($idBand)
    {
        $band = Band::getDetailsBand($idBand);
        $allAlbumsOfBand = Band::getAlbumsOfBand($idBand);
        $randomBarMusics = Music::getRandomMusics();
        $allMusicsOfBand = Music::where('band_id', $idBand)->paginate(10);
        return view('pages.bands.index_band', compact('band', 'allAlbumsOfBand', 'allMusicsOfBand', 'randomBarMusics'));
    }

    public function createBandView()
    {
        $paises = DB::table("countries")->get()->all();
        $randomBarMusics = Music::getRandomMusics();
        $genres = Genero::get()->all();
        return view('pages.bands.create_band', compact('paises', 'genres', 'randomBarMusics'));
    }

    public function storeBand(Request $request)
    {
        $request->validate([
            'band_name' => 'required|unique:bands,name',
            'band_released_at' => 'date|nullable',
            'country_band' => 'exists:countries,id',
            'inputGenres' => 'present|array',
            'inputGenres.*' => 'exists:generos,id',
            'photo' => 'max:10000',
        ]);
        if ($request->hasFile('photo')) {
            $photo = Storage::putFile('bands/', $request->photo);
            $newBand = Band::insertGetId([
                'name' => $request->band_name,
                'founded_at' => $request->band_released_at,
                'photo' => $photo,
                'country_id' => $request->country_band,
            ]);

        } else {
            $newBand = Band::insertGetId([
                'name' => $request->band_name,
                'founded_at' => $request->band_released_at,
                'photo' => 'musicCoverDefault.png',
                'country_id' => $request->country_band,
            ]);
        }

        foreach ($request->inputGenres as $genre) {
            DB::table('bandgeneros')->insert([
                'band_id' => $newBand,
                'genero_id' => $genre
            ]);
        }
        return redirect()->route('user_dashboard');
    }

    public function editband(Request $request)
    {
        $band = Band::where('id', $request->id)->first();
        if ($request->band_name == $band->name) {
            $request->validate([
                'band_founded_at' => 'date|nullable',
                'band_image' => 'image',
                'band_country' => 'exists:countries,id',
            ]);
        } else {
            $request->validate([
                'band_name' => 'string|unique:bands,name',
                'band_founded_at' => 'date|nullable',
                'band_image' => 'image|nullable',
                'band_country' => 'exists:countries,id',
            ]);
        }
        $photo = null;
        if ($request->hasFile('band_image')) {
            if($band->photo != 'musicCoverDefault.png')
            {
                Storage::delete($band->photo);
            }
            $photo = Storage::putFile("bands/", $request->band_image);
        }
        Band::where('id', $request->id)->update([
            'name' => $request->band_name,
            'founded_at' => $request->band_founded_at,
            'photo' => $photo ? $photo : $band->photo,
            'country_id' => $request->band_country
        ]);
        return redirect()->back()->with('message', 'Band Atualizada com sucesso!');

    }

    public function editBandView($bandId)
    {
        $countries = DB::table("countries")->get()->all();
        $randomBarMusics = Music::getRandomMusics();
        $band = Band::where('id', $bandId)->get()->first();
        $allAlbumsOfBand = Band::getAlbumsOfBand($bandId);
        $allMusicsOfBand = Music::where('band_id', $bandId)->paginate(10);
        return view('pages.bands.edit_band', compact('band', 'randomBarMusics', 'countries', 'allMusicsOfBand', 'allAlbumsOfBand'));
    }

    public function deleteBand($bandId)
    {
        Band::where('id', $bandId)->delete();
        return redirect()->route('user_dashboard');
    }
}
