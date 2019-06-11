<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'name' => 'dmitriy',
            'email' => 'dv@gmail.com',
            'password' => bcrypt('dmitriy'),
            'role' =>'admin'
        ]);
        User::create([
            'name' => 'aaaaaaaa',
            'email' => 'aa@gmail.com',
            'password' => bcrypt('password')
        ]);
        factory(User::class,15)->create();
    }
}
