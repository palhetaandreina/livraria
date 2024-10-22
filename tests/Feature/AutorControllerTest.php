<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Autor;


class AutorControllerTest extends TestCase
{
    use RefreshDatabase;
    public function pode_listar_autores_com_paginacao()
    {
        Autor::factory()->count(15)->create();
        $response = $this->get('/autores');

        $response->assertStatus(200);
        $response->assertViewHas('autores');
    }

    public function pode_criar_um_novo_autor()
    {
        $dados = [
            'nome' => 'Autor Teste',
            'biografia' => 'Biografia do autor teste',
            'data_nascimento' => '1990-01-01',
        ];
        $response = $this->post('/autores', $dados);
        $response->assertRedirect('/autores');
        $this->assertDatabaseHas('autores', ['nome' => 'Autor Teste']);
    }
    /**@test */
    public function pode_atualizar_um_autor_existente()
    {
        $autor = Autor::factory()->create();
        dd($autor);
        
        $dadosAtualizados = [
            'nome' => 'Nome Atualizado',
            'biografia' =>  'Biografia atualizada',
        ];

        $response = $this->put("/autores/{$autor->id}", $dadosAtualizados);
        $response->assertRedirect('/autores');

        $this->assertDatabaseHas('autores', ['nome' => 'Nome Atualizado']);
    }

    public function pode_excluir_um_autor()
    {
        $autor = Autor::factory()->create();

        $response = $this->delete("/autores/{$autor->id}");

        $response->assertRedirect('/autores');
        $this->assertDatabaseMissing('autores', ['id' => $autor->id]);
    }

    public function performance_listar_autores_com_paginacao()
    {
        Autor::factory()->count(500)->create();
        $start = microtime(true);
        $response = $this->get('/autores');
        $duration = microtime(true) - $start;
        $response->assertStatus(200);
        $this->assertTrue($duration < 2, "O tempo de resposta foi maior que 2 segundos: {$duration} segundos");
    }

    /**@test */
    public function performance_criar_autores_em_massa()
    {
        $start = microtime(true);
        Autor::factory()->count(1000)->create();
        $duration = microtime(true) - $start;
        $this->assertTrue($duration < 5, "O tempo de resposta foi maior que 5 segundos: {$duration} segundos");
    }
}
