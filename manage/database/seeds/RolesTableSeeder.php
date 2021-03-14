<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role;
        $role->name = 'developer';
        $role->guard_name = 'web';
        $role->save();

        $role = new Role;
        $role->name = 'superadmin';
        $role->guard_name = 'web';
        $role->save();

        $role = new Role;
        $role->name = 'admin';
        $role->guard_name = 'web';
        $role->save();

        $role = new Role;
        $role->name = 'user';
        $role->guard_name = 'web';
        $role->save();
    }
}
