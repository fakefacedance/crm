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
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'admin']);
        $manager = Role::create(['name' => 'manager']);

        $permissions = [
            'add funnel'           => [  $admin             ],
            'edit funnel'          => [  $admin             ],
            'delete funnel'        => [  $admin             ],
            'add client'           => [  $admin,  $manager  ],
            'add employee'         => [  $admin             ],
            'edit employee'        => [  $admin             ],
            'delete employee'      => [  $admin             ],
            'add role'             => [  $admin             ],
            'edit role'            => [  $admin             ],
            'delete role'          => [  $admin             ],
            'add task'             => [  $admin,  $manager  ],
            'assign to task'       => [  $admin             ],
            'add deal'             => [  $admin,  $manager  ],
            'edit any deal'        => [  $admin             ],
        ];

        foreach ($permissions as $permissionKey => $roles) {
            $permission = Permission::create(['name' => $permissionKey]);               
            foreach ($roles as $role) {                 
                $role->givePermissionTo($permission);
            }
        }                                               
    }
}
