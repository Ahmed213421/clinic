<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Create Permissions with 'admin' guard
        $permissions = [
            'view-role', 'create-role', 'update-role', 'delete-role',
            'view-permission', 'create-permission', 'update-permission', 'delete-permission',
            'view-user', 'create-user', 'update-user', 'delete-user',
            'view-product', 'create-product', 'update-product', 'delete-product',
            'view-clinic','create-clinic','update-clinic','delete-clinic',
            'view-doctor','create-doctor','update-doctor','delete-doctor',
            'view-appointment','create-appointment','update-appointment','delete-appointment',
            'view-userAppointment','create-userAppointment','update-userAppointment','delete-userAppointment',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'admin']);
        }

        // Create Roles with 'admin' guard
        $superAdminRole = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'admin']);
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'admin']);
        $doctorRole = Role::firstOrCreate(['name' => 'doctor', 'guard_name' => 'admin']);

        // Assign all permissions to the 'super-admin' role
        $superAdminRole->givePermissionTo(Permission::all());

        // Assign specific permissions to the 'admin' role
        $doctorPermissions = [

            'view-appointment','view-clinic',
        ];
        $doctorRole->syncPermissions($doctorPermissions);


        $adminUser = Admin::firstOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'Admin',
            'password' => Hash::make('123'),
            'status' => 'active',
        ]);
        
        // Assign Roles to Users
        $superAdminUser = Admin::where('email','admin@gmail.com')->first();
        if ($superAdminUser) {
            $superAdminUser->assignRole($superAdminRole);
        } else {
            $this->command->warn('Super Admin user (ID: 1) not found.');
        }



        $doctorUser = Admin::firstOrCreate([
            'email' => 'spiderofegypt98@gmail.com',
        ], [
            'name' => 'doctor',
            'specialization_id' => '1',
            'password' => Hash::make('123'),
            'status' => 'active',
        ]);

        // Admin::create([
        //     'name' => 'Ahmed Samir',
        //     'email' => 'admin@admin.com',
        //     'type' => 'super_admin',
        //     'password' => Hash::make('123'),
        //     'status' => 'active',
        // ]);
        // Admin::create([
        //     'name' => 'Ahmed Samir',
        //     'email' => 'spiderofegypt98@gmail.com',
        //     'type' => 'super_admin',
        //     'password' => Hash::make('123'),
        //     'status' => 'active',
        // ]);

        $adminUser->assignRole($adminRole);
        $doctorUser->assignRole($doctorRole);
    }
}
