<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'app_name'     => 'SupportDesk',
                'description'  => 'SupportDesk- Sistema de Chamados',
                'email'        => 'contato@supportdesk.com.br',
                'phone'        => null,
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
