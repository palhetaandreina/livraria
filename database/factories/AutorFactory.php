<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Autor;

class AutorFactory extends Factory
{

    protected $model = Autor::class;
    public function definition()
    {
        return [
            'nome' => $this->faker->name(),
            'biografia' => $this->faker->paragraph(),
            'data_nascimento' => $this->faker->date(),
        ];
    }
}
