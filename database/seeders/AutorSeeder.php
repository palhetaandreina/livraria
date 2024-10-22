<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Autor;

class AutorSeeder extends Seeder
{
    public function run()
    {
       Autor::factory()->count(10)->create();
    }
}
