<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        factory(User::class)->create(['name' => 'Andy Newhouse', 'email' => 'hi@andymnewhouse.me']);
        factory(User::class)->create(['name' => 'Becca Swick', 'email' => 'beccaswick26@gmail.com']);
        factory(User::class)->create(['name' => 'Pam Swick', 'email' => 'pswick62@gmail.com']);
        factory(User::class)->create(['name' => 'Dan Swick', 'email' => 'drsswick@gmail.com']);
        factory(User::class)->create(['name' => 'Jess Newhouse', 'email' => 'jessnewhouse24@gmail.com']);
    }
}
