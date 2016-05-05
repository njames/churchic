<?php

use Illuminate\Database\Seeder;
use ChurchIC\Models\User;
use ChurchIC\Models\Team;
use Illuminate\Support\Facades\Hash;
//Use ;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->delete();

        Team::create([
            'owner_id' => 1,
            'name'     => 'HopeUC'
        ]);

        DB::table('users')->delete();

        User::create([
            'name' => 'Nigel James',
            'email'=> 'nigel.james@squarecloud.com.au',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Elisa James',
            'email'=> 'elisa.james@squarecloud.com.au',
            'password' => Hash::make('password')
        ]);

        // there must be a way to seed the team join table without resorting to this.
        DB::insert('INSERT INTO team_users (team_id, user_id, role) VALUES (?, ?, ?)', [1, 1, 'owner']);
        DB::insert('INSERT INTO team_users (team_id, user_id, role) VALUES (?, ?, ?)', [1, 2, 'member']);

    }
}
