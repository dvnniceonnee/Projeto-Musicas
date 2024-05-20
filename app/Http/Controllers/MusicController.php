<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Band;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function Symfony\Component\VarDumper\Dumper\esc;

class MusicController extends Controller
{
    public function indexMusic($idmusic)
    {
        $randomBarMusics = IndexController::getRandomMusics();
        $music = $this->getMusic($idmusic);
        $randomMusics = Arr::take(Arr::shuffle(Music::where('band_id', $music->band_id)->get()->all()), 15);
        $this->getSimilarMusics($music->band_id);
        return view('musics.index_music', compact('randomBarMusics', 'music', 'randomMusics'));
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

    public function createMusicView()
    {
        $randomBarMusics = IndexController::getRandomMusics();
        $albums = Album::where('band_id', 1)->get()->all();
        return view('musics.create_music', compact('albums', 'randomBarMusics'));
    }

    public function editMusicView($idMusic){
        $randomBarMusics = IndexController::getRandomMusics();
        $music = $this->getMusic($idMusic);
        return view('musics.edit_music', compact('randomBarMusics', 'music'));
    }

    public function editMusic(Request $request){
        if(isset($request->id)){
            $request->validate([
                'music_name' => 'required|unique:musics,name',
                'music_length' => 'numeric|required',
                'music_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            ]);
            $musicPhoto = null;
            if($request->hasFile('music_image')){
                $musicPhoto = Storage::putFile('music/', $request->music_image);
                Music::where('id', $request->id)->update([
                    'name' => $request->music_name,
                    'length' => $request->music_length,
                    'photo' => $musicPhoto
                ]);
            }
            else{
                Music::where('id', $request->id)->update([
                    'name' => $request->music_name,
                    'length' => $request->music_length
                ]);
            }

        }

    }

    public function storeMusic(Request $request)
    {
        $band_id = -1;
        if ($request->album_id != null) {
            $band_id = Album::where('id', $request->album_id)->get()->first()->band_id;
        }
        $request->validate([
            'music_name' => 'required|unique:musics,name',
            'music_length' => 'numeric|required',
            'music_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            'band_id' => "integer|size:$band_id"
        ]);
        $photo = null;
        if ($request->hasFile('music_image')) {
            $photo = Storage::putFile('music/', $request->band_image);
        }
        $newMusic = Music::insert([
            'name' => $request->music_name,
            'photo' => $photo ? $photo : 'music/musicCoverDefault.png',
            'band_id' => $request->band_id,
            'album_id' => $request->album_id
        ]);

    }

    public function deleteMusic($idMusic){
        Music::where('id', $idMusic)->delete();
        return redirect()->route('user_dashboard');
    }
}
