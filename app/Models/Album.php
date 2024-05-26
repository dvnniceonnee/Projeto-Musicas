<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Album extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * Method that returns 6 random Albums and add to each one of them a field with the name
     * @return array
     */
    public static function getSixRandomAlbums()
    {
        $sixAlbums = Arr::take(Arr::shuffle(Album::get()->all()), 6);

        foreach ($sixAlbums as $album) {
            $bandName = Band::where('id', $album->band_id)->get()->first()->name;
            Arr::add($album, 'band_name', $bandName);
        }
        return $sixAlbums;
    }
}
