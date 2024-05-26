<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;

class Band extends Model
{
    use HasFactory;

    /**
     * Method to return 6 random bands and for each band the method will add a array of the genres that the band has
     * @return array With 6 bands
     */
    public static function getRandomSixBands()
    {
        $sixBands = Arr::take(Arr::shuffle(Band::get()->all()), 6);
        foreach ($sixBands as $band) {
            $arrayGeneros = DB::table('bandgeneros')->where('band_id', $band->id)->select('genero_id')->get();
            $array = [];
            foreach ($arrayGeneros as $genero) {
                $array[$genero->genero_id] = Genero::where('id', $genero->genero_id)->get()->first()->name;
            }
            Arr::add($band, 'genres', $array);
        }
        return $sixBands;
    }

    public function getBandsByGenre($idGenre){
        $bandByGenero = DB::table('bandgeneros')->select('band_id')->where('genero_id', $idGenre);
        return $bandByGenero;
    }

    /**
     * Method that returns all the generos of a Band
     * @param $idBand Id of the band
     * @return
     */
    public static function getIdOfGenresOfBand($idBand){
        $bandGenres = DB::table('bandgeneros')->select('genero_id')->where('band_id', $idBand)->get();
        return $bandGenres;
    }

    /**
     * Method that returns the full details of a band
     * @param $id id as a integer of the band to search for
     * @return array of the band with some extra fields (['band_country', 'band_genres[]'])
     */
    public static function getDetailsBand($id)
    {
        $band = Band::where('id', $id)->first();
        $countryBand = DB::table('countries')->where('id', $band->country_id)->first()->name;
        $band = Arr::add($band, 'band_country', $countryBand);
        $band = Arr::add($band, 'band_genres', Band::getGenresOfBand($id));
        return $band;
    }

    /**
     * @param $id Id of The band that we want to search for the genres
     * @return array With all the genres names
     */
    public static function getGenresOfBand($id)
    {
        $genresBand = DB::table('bandgeneros')->where('band_id', $id)->get();
        $genres = [];
        foreach ($genresBand as $genre) {
            $newArray = collect(['genre_id' => $genre->genero_id, 'genre_name' => Genero::where('id', $genre->genero_id)->first()->name]);
            array_push($genres, $newArray);
        }
        return $genres;
    }

    /**
     * Method that retuns all albums of a band
     * @param $idBand id of the band
     * @return mixed array with the albums
     */
    public static function getAlbumsOfBand($idBand)
    {
        $albumsOfBand = Album::where('band_id', $idBand)->get();
        return $albumsOfBand;
    }

}
