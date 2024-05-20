<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Band;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function indexDashboard(){
        $allBands = $this->getAllBands();
        $allAlbums = $this->getAllAlbums();
        $allMusics = $this->getAllMusics();
        return view('user.dashboard_admin', compact('allBands', 'allAlbums', 'allMusics'));
    }

    private function getAllMusics(){
        $allMusics = Music::get();
        foreach ($allMusics as $music){
            $music = MusicController::getMusicDetails($music);
        }
        return $allMusics;
    }

    private function getAllAlbums(){
        $allAlbums = Album::get();
        $albumController = new AlbumController();
        foreach ($allAlbums as $album){
            $completeAlbum = $albumController->getAlbumDetails($album->id);
            Arr::add($album, 'band_name', $completeAlbum->band_name);
            Arr::add($album, 'number_tracks', $completeAlbum->number_tracks);
        }
        return $allAlbums;
    }
    private function getAllBands(){
        $allBands = Band::get();
        foreach ($allBands as $band) {
            $pais = DB::table('paises')->where('id', $band->pais_id)->first();
            Arr::add($band, 'founded_in', $pais->name);
        }
        return $allBands;
    }
}
