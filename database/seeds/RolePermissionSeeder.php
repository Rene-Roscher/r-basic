<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = [
            'Super Admin' => [],
            'Team' => [],
        ];
        foreach (['user', 'session', 'role', 'permission'] as $i)
            $arr['Team'] = array_merge([
                "$i.list",
                "$i.show",
                "$i.update",
                "$i.create",
                "$i.delete",
            ],$arr['Team']);
        foreach ($arr as $role => $permissions) {
            $role = Role::create(['name' => $role]);
            foreach ($permissions as $permission) {
                $permission = Permission::create(['name' => $permission]);
                $role->givePermissionTo($permission);
            }
        }
    }
}
