<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            [
                'name'        => 'Administradores',
                'description' => 'Grupo de Administradores do Sistema',
                'status'      => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Suportes',
                'description' => 'Grupo de Suporte Técnico',
                'status'      => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Usuários',
                'description' => 'Grupo de Usuários Solicitantes',
                'status'      => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}