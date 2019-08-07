<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SettingsTableSeeder::class,
            GroupsTableSeeder::class,
            CompaniesTableSeeder::class,
            UsersTableSeeder::class,
            PermissionsTableSeeder::class,
            GroupPermissionTableSeeder::class,
            SystemsTableSeeder::class,
            SystemUserTableSeeder::class,
            CategoriesTableSeeder::class,
        ]);
    }
}
