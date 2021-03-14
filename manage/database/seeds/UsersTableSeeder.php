<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'developer',
            'email' => 'developer@developer.com',
            'phone' => '08222221112',
            'password' => Hash::make('password')
        ]);

        $user->syncRoles(['developer', 'superadmin', 'admin']);

        $user = User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@superadmin.com',
            'phone' => '08222211111',
            'password' => Hash::make('password')
        ]);

        $user->syncRoles(['superadmin']);

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'phone' => '08222211111',
            'password' => Hash::make('password')
        ]);

        $user->syncRoles(['admin']);
    }
}
