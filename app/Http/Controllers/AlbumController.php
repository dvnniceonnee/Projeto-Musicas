<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Band;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

class AlbumController
{
    public function indexAlbum($idAlbum){
        $album = $this->getAlbumDetails($idAlbum);
        $randomBarMusics = Music::getRandomMusics();
        $allMusicsOfAlbum = $this->getAllMusicsOfAlbum($idAlbum);
        $albumsOfBand = Band::getAlbumsOfBand($album->band_id);
        return view('pages.albums.index_album', compact('randomBarMusics', 'album', 'allMusicsOfAlbum', 'albumsOfBand'));
    }

    public function getAlbumDetails($idAlbum){
        $album = Album::where('id', $idAlbum)->first();
        $album->genres_band = Band::getGenresOfBand($album->band_id);
        $album->band_name = Band::where('id', $album->band_id)->first()->name;
        $album->number_tracks = $this->getAllMusicsOfAlbum($idAlbum)->count();
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
        $randomBarMusics = Music::getRandomMusics();
        return view('pages.albums.create_album', compact('bandExists', 'allBands', 'randomBarMusics'));
    }

    public function storeAlbum(Request $request){
//        dd($request->all());
        $request->validate([
            'album_name'=> 'unique:albums,name|required|max:255',
            'released_at' => 'date|required',
            'band_id'=> 'required|exists:bands,id',
//            'album_image'=> 'nullable|image|max:10000',
        ]);
        $photo = null;
        if($request->hasFile('album_image')) {
            $photo = Storage::putFile("albums/", $request->album_image);
        }
        $newAlbum = Album::insertgetId([
            'name'=>$request->album_name,
            'photo'=> $photo ? $photo : 'music/musicCoverDefault.png',
            'band_id'=>$request->band_id,
            'released_at'=>$request->released_at
        ]);
        return redirect()->route('user_dashboard')->with('message', 'Album '.$request->album_name.' criado com sucesso!');
    }

    public function editAlbumView($albumId){
        $album = Album::where('id', $albumId)->first();
        if($album){
            $allMusicsOfAlbum = Music::where('album_id', $albumId)->paginate(10);
            $randomBarMusics = Music::getRandomMusics();
            return view('pages.albums.edit_album', compact('album', 'randomBarMusics', 'allMusicsOfAlbum'));
        }
        else{
            return redirect()->route('route_home');
        }

    }

    public function editAlbum(Request $request){
        $album = Album::where('id', $request->id)->first();
        if($request->album_name == $album->name )
        {
            $request->validate([
                'album_released_at' => 'date',
                'album_photo' => 'image'
            ]);
        }else{
            $request->validate([
                'album_name'=> 'unique:albums,name|max:255',
                'album_released_at' => 'date',
                'album_photo' => 'image'
            ]);
        }
        $photo = null;
        if ($request->hasFile('album_photo')) {
            if($album->photo){
                Storage::delete($album->photo);
            }
            $photo = Storage::putFile("albums/",$request->album_photo);
        }
        Album::where('id', $request->id)->update([
            'name' => $request->album_name,
            'released_at' => $request->album_released_at,
            'photo' => $photo ? $photo : $album->photo,
        ]);

        return redirect()->back()->with('message', 'Album atualizado com sucesso!');
    }

    public function deleteAlbum($albumId){
        Music::where('album_id', $albumId)->delete();
        Album::where('id', $albumId)->delete();
        return redirect()->route('user_dashboard')->with('message', 'Album Apagado com sucesso!');
    }
}
