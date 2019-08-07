<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            [
                'name'        => 'Empresa Teste',
                'description' => 'Descrição da Empresa',
                'status'      => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}

