<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Str;
class PacienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('pt_BR');
        for ($i=0; $i<100; $i++) {
            DB::table('pacientes')->insert([
                'nome' => $faker->name,
                'cpf' => $faker->cpf,
                'telefone' => sprintf('(0%s) %s', $faker->areaCode, $faker->landline),
            ]);
        }
    }
}
