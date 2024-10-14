<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $edit = Permission::create(['name' => 'edit']);
        $delete = Permission::create(['name'=> 'delete']);
        $view = Permission::create(['name'=> 'view']);

        $owner = Role::create(['name' => 'owner']);
        $owner->givePermissionTo([$edit, $delete, $view]);

        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([$edit, $view]);

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo($view);
    }
}