<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Band;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function Symfony\Component\VarDumper\Dumper\esc;

class MusicController extends Controller
{
    public function indexMusic($idmusic)
    {
        if(!Music::where('id', $idmusic)->exists()){
            return view('Errors.fallback');
        }
        $randomBarMusics = IndexController::getRandomMusics();
        $favoritosuser = DB::table('userfavourites')->where('user_id', Auth::id())->get();
        $music = $this->getMusic($idmusic);
        $randomMusics = Arr::take(Arr::shuffle(Music::where('band_id', $music->band_id)->get()->all()), 15);
        $this->getSimilarMusics($music->band_id);
        $music->favourite_user = $favoritosuser->contains('music_id', $idmusic);
        return view('pages.musics.index_music', compact('randomBarMusics', 'music', 'randomMusics'));
    }

    public function addToFavourites($idMusic)
    {
        $favoritos = DB::table('userfavourites')->where('user_id', Auth::id())->get();
        if ($favoritos->contains('music_id', $idMusic)) {
            DB::table('userfavourites')->where(['user_id' => Auth::user()->id, 'music_id' => $idMusic])->delete();
        } else {
            DB::table('userfavourites')->insert([
                'music_id' => $idMusic,
                'user_id' => Auth::user()->id,
            ]);
        }
        return redirect()->back();
    }

    private function getSimilarMusics($bandId)
    {
        $genres[] = BandController::getGenresOfBand($bandId);
        $musics[] = [];
    }

    private function getMusic($idmusic)
    {
        $music = Music::where('id', $idmusic)->first();
        Arr::add($music, 'band_name', Band::where('id', $music->band_id)->first()->name);
        Arr::add($music, 'album_name', Album::where('id', $music->album_id)->first()->name);
        return $music;
    }

    public static function getMusicDetails($music)
    {
        Arr::add($music, 'band_name', Band::where('id', $music->band_id)->first()->name);
        Arr::add($music, 'album_name', Album::where('id', $music->album_id)->first()->name);
        return $music;
    }

    public function createMusicView($idBand, $idAlbum)
    {
        $album = Album::where('id', $idAlbum)->get();
        $band = Band::where('id', $idBand)->first();
        $albums = null;
        if($band != null){
            $albums = Album::where('band_id', $idBand)->get();
        }
        else{
            if($album->count() > 0){
                $albums = $album;
            }
            else{
                $albums = Album::get();
            }
        }
        $randomBarMusics = IndexController::getRandomMusics();

        return view('pages.musics.create_music', compact('albums', 'randomBarMusics'));
    }

    public function editMusicView($idMusic)
    {
        $randomBarMusics = IndexController::getRandomMusics();
        $music = $this->getMusic($idMusic);
        return view('pages.musics.edit_music', compact('randomBarMusics', 'music'));
    }

    public function editMusic(Request $request)
    {
        if (isset($request->id)) {
            $music = Music::where('id', $request->id)->first();
            if ($music->name == $request->music_name) {
                $request->validate([
                    'music_length' => 'numeric',
                    'music_image' => 'nullable|image|max:10000',
                ]);

            } else {
                $request->validate([
                    'music_name' => 'required|unique:musics,name',
                    'music_length' => 'numeric',
                    'music_image' => 'nullable|image|max:10000',
                ]);
            }

            $musicPhoto = null;
            if ($request->hasFile('music_image')) {
                if ($music->photo != 'musicCoverDefault.png') {
                    Storage::delete($music->photo);
                }
                $musicPhoto = Storage::putFile('music/', $request->music_image);
                Music::where('id', $request->id)->update([
                    'name' => $request->music_name,
                    'length' => $request->music_length,
                    'photo' => $musicPhoto
                ]);
            } else {
                Music::where('id', $request->id)->update([
                    'name' => $request->music_name,
                    'length' => $request->music_length
                ]);
            }
            return redirect()->back()->with('message', 'Musica atualizada com sucesso');
        }
    }

    public function storeMusic(Request $request)
    {
        $band_id = -1;
        if ($request->album_id != null) {
            $band_id = Album::where('id', $request->album_id)->first()->band_id;
        }
        $request->validate([
            'music_name' => 'required|unique:musics,name',
            'music_length' => 'numeric|required',
            'music_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'album_id' => "required|exists:albums,id",
        ]);
        $photo = null;
        if ($request->hasFile('music_image')) {
            $photo = Storage::putFile('music/', $request->music_image);
        };
        $newMusic = Music::insertGetId([
            'name' => $request->music_name,
            'photo' => $photo ? $photo : 'musicCoverDefault.png',
            'band_id' => $band_id,
            'album_id' => $request->album_id,
            'length' => $request->music_length
        ]);
        return redirect()->route('user_dashboard', $newMusic)->with('message', 'Musica inserida com sucesso');

    }

    public function deleteMusic($idMusic)
    {
        $music = Music::where('id', $idMusic)->first();
        $music->delete();
        return redirect()->route('user_dashboard')->with('message', $music->name . ' Apagada com sucesso');
    }
}
