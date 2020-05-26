<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Landley Bernardo',
            'email' => 'landleydgreat@gmail.com',
            'password' => Hash::make('12345678'),
            'status' => 'registered',
            'user_type' => 'admin',
            'property' => 'The Courtyards'
        ]);
    }
}
