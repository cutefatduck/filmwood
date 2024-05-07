<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaShowResource extends JsonResource
{
  
// Transform the resource into an array.
// @return array<string, mixed>

public function toArray(Request $request): array
{
    //if no resize image

    $resized_image="";
    try {
        $resized_image = $this->getMedia('*');//[0]->getUrl('resized-image');
        // return resized_image;
        if(count($resized_image) != 0){
            // $resized_image = $resized_image[0]->getUrl('resized-image');
        }} catch (Exception $e) {
            $resized_image="";
        }
        return [
            'id' => $this->id,'id_country' => $this->id_country,'id_media_show_type' => $this->id_media_show_type,'id_pemi' => $this->id_pemi,'nombre' => $this->nombre,'duracion' => $this->duracion,'actores' => $this->actores,'sinopsis_corta' => $this->sinopsis_corta,'sinopsis' => $this->sinopsis,'portada_img' => count($this->getMedia('*')) > 0 ? $this->getMedia('*')[0]->getUrl() : null,'idioma' => $this->idioma,'directores' => $this->directores,'trailer' => $this->trailer,'fecha_media_show' => $this->fecha_media_show,'saga' => $this->saga,'episodios' => $this->episodios,'temporadas' => $this->temporadas,'genres' => $this->genres,
        ];
    return parent::toArray($request);
    }
}

