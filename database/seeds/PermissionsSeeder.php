<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create admins']);
        Permission::create(['name' => 'edit admins']);
        Permission::create(['name' => 'delete admins']);

        Permission::create(['name' => 'add users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'add drug']);
        Permission::create(['name' => 'edit drug']);
        Permission::create(['name' => 'delete drug']);

        Permission::create(['name' => 'order drug']);
        Permission::create(['name' => 'see order']);
        Permission::create(['name' => 'delete order']);
        // create roles
        $role1 = Role::create(['name' => 'super-admin']);

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('add users');
        $role2->givePermissionTo('edit users');
        $role2->givePermissionTo('delete users');

        $role2->givePermissionTo('add drug');
        $role2->givePermissionTo('edit drug');
        $role2->givePermissionTo('delete drug');

        $role2->givePermissionTo('see order');
        $role2->givePermissionTo('delete order');

        $role3 = Role::create(['name' => 'provider']);
        $role3->givePermissionTo('add drug');
        $role3->givePermissionTo('edit drug');
        $role3->givePermissionTo('delete drug');
        $role3->givePermissionTo('see order');

        $role4 = Role::create(['name' => 'pharmacy']);
        $role4->givePermissionTo('order drug');
        $role4->givePermissionTo('see order');
        $role4->givePermissionTo('delete order');


    }
}
