<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\p_media_show;
use App\Models\User;

class MediaShowControllerTest extends TestCase
{

    /**
     * Test index method
     */
    public function testIndex()
    {
        // Realizar una solicitud GET a la ruta correspondiente
        $response = $this->get('api/media');

        // Verificar que la respuesta tenga el código HTTP 200 y contenga datos válidos
        $response->assertStatus(200);
    }

    public function testMediaShow()
    {
        // Suponiendo que el ID 1 existe en tu base de datos
        $response = $this->get('api/media/1');

        $response->assertStatus(200);
    }
    public function testMediaSearch()
    {
    // Suponiendo que tienes una query válida para buscar
        $searchQuery = ['search' => 'American'];

        $response = $this->get('api/media/search', $searchQuery);

        $response->assertStatus(200);
    }

    public function testMediaDestroy()
    {
        // Suponiendo que el ID 1 existe en tu base de datos
        $idToDelete = 3;

        // Realizar la solicitud DELETE
        $response = $this->delete("api/media/{$idToDelete}");

        $response->assertStatus(200);
    }

    public function testAddValorations()
    {
        // Crear un usuario ficticio (puedes ajustar esto según tus necesidades)
        $user = User::factory()->create();

        // Datos de la valoración a enviar
        $valorationData = [
            'id_media_show' => 1,
            'puntuacion' => 5,
            'valoracion' => 'Me encantó',
            'recomendacion' => true,
        ];

        // Realizar una solicitud POST al endpoint del controlador
        $response = $this->actingAs($user)->postJson('api/media/valoration', $valorationData);

        // Verificar que se creó la valoración en la base de datos
        $response->assertStatus(201);

    }

    public function testGetMediaShowValorations()
    {
        // Supongamos que tienes un ID de media show válido
        $mediaShowId = 1;

        // Realizar la solicitud GET para obtener las valoraciones
        $response = $this->get("api/media/valorations/{$mediaShowId}");

        $response->assertStatus(200);
    }
    
    public function testGetMediaShowByGenre()
    {
        // Supongamos que tienes un ID de género válido
        $genreId = 1;

        // Realizar la solicitud GET para obtener los media shows por género
        $response = $this->get("api/genres/media/{$genreId}");

        $response->assertStatus(200);
    }

    public function testStoreMediaShowByGenre(){

        $mediaShowData =[
                "id_country" => 1,
                "id_media_show_type" => 2,
                "id_pemi" => 4,
                "nombre" => "Test",
                "duracion" => "00:45:00",
                "actores" => "actores",
                "sinopsis_corta" => "Descripcion Test",
                "portada_img" => "http://localhost:8000/images/portada_american_horror_story.jpg",
                "idioma" => "Castellano, Inglés",
                "directores" => "Ryan Murphy, Brad Falchuk",
                "sinopsis" => "sinopsis",
                "fecha_media_show" => "2011-11-05",
                "trailer" => "http://localhost:8000/videos/trailer_american_horror_story.mp4",
                "saga" => null,
                "episodios" => 128,
                "temporadas" => 12,
                "genres" => "4, 11"
        ];

        $response = $this->postJson("api/media", $mediaShowData);
        $response->assertStatus(201);
    }

}