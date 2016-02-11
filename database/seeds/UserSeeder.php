<?php

use Illuminate\Database\Seeder;
use Cic\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'client_id' => 'hopeuc',
            'name' => 'Nigel',
            'email'=> 'nigel.james@squarecloud.com.au',
            'password' => Hash::make('password')
        ]);

        User::create([
            'client_id' => 'hopeuc',
            'name' => 'Elisa',
            'email'=> 'elisa.james@squarecloud.com.au',
            'password' => Hash::make('password')
        ]);

    }
}
