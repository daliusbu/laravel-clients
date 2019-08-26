<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory('App\User', 3)->create();
        DB::table('users')
            ->updateOrInsert(
                [
                    'email' => 'root',
                ],
                [
                    'name' => 'Root Administrator',
                    'email' => 'root',
                    'password' => Hash::make('root'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
    }
}
