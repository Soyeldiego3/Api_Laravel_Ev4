<?php

namespace Tests\Feature;

use App\Models\Catalogo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CatalogoApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_lista_catalogos(): void
    {
        Catalogo::create([
            'nombre' => 'Prod 1',
            'descripcion' => 'Desc 1',
            'precio' => 100,
            'stock' => 5,
            'estado' => 'activo',
        ]);

        $this->getJson('/api/catalogos')
            ->assertStatus(200)
            ->assertJsonFragment(['nombre' => 'Prod 1']);
    }

    public function test_crea_catalogo(): void
    {
        $data = [
            'nombre' => 'Nuevo',
            'descripcion' => 'Desc',
            'precio' => 200,
            'stock' => 3,
            'estado' => 'activo',
        ];

        $this->postJson('/api/catalogos', $data)
            ->assertStatus(201)
            ->assertJsonFragment(['nombre' => 'Nuevo']);

        $this->assertDatabaseHas('catalogos', ['nombre' => 'Nuevo']);
    }

    public function test_muestra_catalogo(): void
    {
        $cat = Catalogo::create([
            'nombre' => 'Ver',
            'descripcion' => 'Desc',
            'precio' => 150,
            'stock' => 4,
            'estado' => 'activo',
        ]);

        $this->getJson("/api/catalogos/{$cat->id}")
            ->assertStatus(200)
            ->assertJsonFragment(['nombre' => 'Ver']);
    }

    public function test_actualiza_catalogo(): void
    {
        $cat = Catalogo::create([
            'nombre' => 'Viejo',
            'descripcion' => 'Desc',
            'precio' => 150,
            'stock' => 4,
            'estado' => 'activo',
        ]);

        $this->putJson("/api/catalogos/{$cat->id}", ['stock' => 20])
            ->assertStatus(200)
            ->assertJsonFragment(['stock' => 20]);
    }

    public function test_elimina_catalogo(): void
    {
        $cat = Catalogo::create([
            'nombre' => 'Borrar',
            'descripcion' => 'Desc',
            'precio' => 120,
            'stock' => 2,
            'estado' => 'activo',
        ]);

        $this->deleteJson("/api/catalogos/{$cat->id}")
            ->assertStatus(204);

        $this->assertDatabaseMissing('catalogos', ['id' => $cat->id]);
    }
}