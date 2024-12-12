<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    public function test_list_posts() {
    $response = $this->get('/api/posts');
    $response->assertStatus(200);
    }

    public function test_create_post() {
        $response = $this->post('/api/posts', [
            'nombre_autor' => 'Test Autor',
            'titulo' => 'Test Título',
            'contenido' => 'Test Contenido',
        ]);
        $response->assertStatus(201)->assertJsonStructure(['message', 'post']);
}
}