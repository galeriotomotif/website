<?php

use App\User;
use Illuminate\Database\Seeder;

class DeveloperUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->name = "developer";
        $user->email = "developer@developer.com";
        $user->password = Hash::make("Hanep_123");
        $user->save();
    }
}
