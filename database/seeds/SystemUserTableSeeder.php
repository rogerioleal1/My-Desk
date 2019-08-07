<?php

use Illuminate\Database\Seeder;

class SystemUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('system_user')->insert([
            [
                'user_id'    => 1,
                'system_id'  => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
