<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        //if no resize image
    
        $resized_image="";
        try {
            $resized_image = $this->getMedia('*');
            if(count($resized_image) != 0){
            }
        } catch (Exception $e) {
            $resized_image="";
        }
        $genresArray = [];
        foreach ($this->genres as $genre) {
            $genreInfo = [
                'id' => $genre['id'],
                'name_genre' => $genre['name_genre']
            ];
            $genresArray[] = $genreInfo;
        }

        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'duracion' => $this->duracion,
            'actores' => $this->actores,
            'sinopsis_corta' => $this->sinopsis_corta,
            'idioma' => $this->idioma,
            'directores' => $this->directores,
            'sinopsis' => $this->sinopsis,
            'fecha_media_show' => $this->fecha_media_show,
            'saga' => $this->saga,
            'episodios' => $this->episodios,
            'temporadas' => $this->temporadas,
            'genres' => $genresArray,
            'country' => $this->country['name'],
            'mediashowtype' => $this->mediaShowType['type'],
            'pemi' => $this->pemi['number_pemi'],
            'portada_img' => $this->portada_img

        ];
        return parent::toArray($request);
    }
}

