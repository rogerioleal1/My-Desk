<?php

use Illuminate\Database\Seeder;

class GroupPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_permission')->insert([
            [
                'group_id'      => 2,
                'permission_id' => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
            [
                'group_id'      => 3,
                'permission_id' => 1,
                'created_at'    => now(),
                'updated_at'    => now()
            ],
        ]);
    }
}
