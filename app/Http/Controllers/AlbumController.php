<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Band;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function indexAlbum($idAlbum){
        $album = $this->getAlbumDetails($idAlbum);
        $randomBarMusics = IndexController::getRandomMusics();
        $allMusicsOfAlbum = $this->getAllMusicsOfAlbum($idAlbum);
        $albumsOfBand = BandController::getAlbumsOfBand($album->band_id);
        return view('musics.index_album', compact('randomBarMusics', 'album', 'allMusicsOfAlbum', 'albumsOfBand'));
    }

    public function getAlbumDetails($idAlbum){
        $album = Album::where('id', $idAlbum)->first();
        Arr::add($album, 'genres_band',BandController::getGenresOfBand($album->band_id));
        Arr::Add($album, 'band_name', Band::where('id', $album->band_id)->first()->name);
        Arr::add($album, 'number_tracks', $this->getAllMusicsOfAlbum($idAlbum)->count());
        return $album;
    }

    private function getAllMusicsOfAlbum($idAlbum){
        $allMusicsOfAlbum = Music::where('album_id', $idAlbum)->get();
        return $allMusicsOfAlbum;
    }
    public function createAlbumView($band_id){
        $band = Band::where('id', $band_id)->get()->first();
        $allBands = null;
        $bandExists = null;
        if($band != null){
            $allBands = $band;
            $bandExists = true;
        }
        else{
            $allBands = Band::get()->all();
            $bandExists = false;
        }
        $randomBarMusics = IndexController::getRandomMusics();
        return view('musics.create_album', compact('bandExists', 'allBands', 'randomBarMusics'));
    }

    public function storeAlbum(Request $request){
        $request->validate([
            'album_name'=> 'unique:albums,name|required|max:255',
            'released_at' => 'date|required',
            'band_id'=> 'required|exists:bands,id',
            'album_image'=> 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
        $photo = null;
        if($request->hasFile('album_image')) {
            $photo = Storage::putFile('music/', $request->band_image);
        }
        $newMusic = Album::insert([
            'name'=>$request->album_name,
            'photo'=> $photo ? $photo : 'music/musicCoverDefault.png',
            'band_id'=>$request->band_id,
            'released_at'=>$request->released_at
        ]);

        return redirect()->back();
    }
}
