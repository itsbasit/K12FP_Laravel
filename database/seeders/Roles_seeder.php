<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;


class Roles_seeder extends Seeder
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
         Permission::create(['name' => 'edit articles']);
         Permission::create(['name' => 'delete articles']);
         Permission::create(['name' => 'publish articles']);
         Permission::create(['name' => 'unpublish articles']);
 
         // create roles and assign existing permissions
        //  fm role
         $fm_role = Role::create(['name' => 'fm']);
         $fm_role->givePermissionTo('edit articles');
         $fm_role->givePermissionTo('delete articles');
        
         //  fm role
         $student_role = Role::create(['name' => 'student']);
         $student_role->givePermissionTo('edit articles');
         $student_role->givePermissionTo('delete articles');

 
         $admin_role = Role::create(['name' => 'super_admin']);
         // gets all permissions via Gate::before rule; see AuthServiceProvider
 
         // create demo users
         $user = \App\Models\User::factory()->create([
             'name' => 'Example User',
             'email' => 'fm@fm.com',
             'password' => Hash::make('fm123456'),
         ]);
         $user->assignRole($fm_role);
 
         $user = \App\Models\User::factory()->create([
             'name' => 'Admin',
             'email' => 'admin@admin.com',
             'password' => Hash::make('admin123456')
         ]);
         $user->assignRole($admin_role);
    }
}