<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $owner = Role::create(['name' => 'owner']);
        $admin = Role::create(['name' => 'admin']);
        $member = Role::create(['name' => 'member']);

        $viewProject = Permission::create(['name' => 'view-project']);
        $addMembers = Permission::create(['name' => 'add-members']);
        $addAdmins = Permission::create(['name' => 'add-admins']);
        $createTasks = Permission::create(['name' => 'create-tasks']);

        $owner->givePermissionTo([$viewProject, $addMembers, $addAdmins, $createTasks]);
        $admin->givePermissionTo([$viewProject, $createTasks, $addMembers]);
        $member->givePermissionTo([$viewProject, $createTasks]);

    }
}
