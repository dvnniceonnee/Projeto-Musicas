<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Ramsey\Collection\Collection;

class Music extends Model
{
    use HasFactory;

    protected $table = 'musics';
    public $timestamps = false;

    /**
     * Method that Returns 15 random Musics with a extra field called 'band_name'
     * @return array With 15 random Musics
     */
    public static function getRandomMusics()
    {
        $randomMusics = Arr::take(Arr::shuffle(Music::get()->all()), 15);
        foreach ($randomMusics as $music) {
            if ($music->photo == 'musicCoverDefault.png') {
                $music->photo = Album::where('id', $music->album_id)->first()->photo;
            }
            $bandName = Band::where('id', $music->band_id)->first();
            Arr::add($music, 'band_name', $bandName->name);
        }
        return $randomMusics;
    }

    public function getAllMusicsByGenre($idGenre)
    {
        $band = new Band();
        $bandsOfGenero = $band->getBandsByGenre($idGenre);
        $musics = Music::whereIn('band_id', $bandsOfGenero)->get();
        foreach ($musics as $music) {
            $music = $this->getMusicDetails($music);
        }
        return $musics;
    }

    /**
     * Method that returns all the details of a Music that will be searched on the DataBase by the id
     * @param $musicObject Object Music
     * @return mixed Object Music with extra fields added (['band_name', 'album_name'])
     */
    public static function getMusicDetails($musicObject)
    {
        if ($musicObject->photo == 'musicCoverDefault.png') {
            $musicObject->photo = Album::where('id', $musicObject->album_id)->first()->photo;
        }
        Arr::add($musicObject, 'band_name', Band::where('id', $musicObject->band_id)->first()->name);
        Arr::add($musicObject, 'album_name', Album::where('id', $musicObject->album_id)->first()->name);
        return $musicObject;
    }

    /**
     * Method to return all musics with or without pagination
     * @param $paginate Number of items per page
     * @return mixed Array of musics
     */
    public function getAllMusics($paginate = 0)
    {
        $musics = null;
        if ($paginate > 0) {
            $musics = Music::paginate($paginate);
        } else {
            $musics = Music::get();
        }
        foreach ($musics as $music) {
            $music = $this->getMusicDetails($music);
        }
        return $musics;
    }

    public static function getMusic($idmusic)
    {
        $music = Music::where('id', $idmusic)->first();
        $music = Music::getMusicDetails($music);
        return $music;
    }
}
