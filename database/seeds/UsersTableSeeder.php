<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	[
	        	'name'           => 'Administrador',
	            'email'          => 'admin@supportdesk.com.br',
	            'password'       =>  Hash::make('12345678'),
                'group_id'       => 1,
                'company_id'     => 1,
	            'remember_token' => str_random(10),
	            'status'         => 1,
	            'created_at'     => now(),
	            'updated_at'     => now()
            ],
            [
	        	'name'           => 'Usuário Técnico',
	            'email'          => 'suporte@supportdesk.com.br',
	            'password'       =>  Hash::make('12345678'),
                'group_id'       => 2,
	            'company_id'     => 1,
	            'remember_token' => str_random(10),
	            'status'         => 1,
	            'created_at'     => now(),
	            'updated_at'     => now()
            ],
            [
	        	'name'           => 'Usuário Solicitante',
	            'email'          => 'usuario@supportdesk.com.br',
	            'password'       =>  Hash::make('12345678'),
                'group_id'       => 3,
	            'company_id'     => 1,
	            'remember_token' => str_random(10),
	            'status'         => 1,
	            'created_at'     => now(),
	            'updated_at'     => now()
			],
	    ]);
    }
}
