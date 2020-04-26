<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $andy = factory(User::class)->create(['name' => 'Andy Newhouse', 'email' => 'hi@andymnewhouse.me']);
        $becca = factory(User::class)->create(['name' => 'Becca Swick', 'email' => 'beccaswick26@gmail.com']);
        $pam = factory(User::class)->create(['name' => 'Pam Swick', 'email' => 'pswick62@gmail.com']);
        $dan = factory(User::class)->create(['name' => 'Dan Swick', 'email' => 'drsswick@gmail.com']);
        $jess = factory(User::class)->create(['name' => 'Jess Newhouse', 'email' => 'jessnewhouse24@gmail.com']);

        $andy->addFriend($becca->id);
        $andy->addFriend($pam->id);
        $andy->addFriend($dan->id);
    }
}
