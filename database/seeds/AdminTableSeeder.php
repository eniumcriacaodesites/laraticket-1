<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Create admin role
        $adminRoleName = 'admin';
        $adminRole = Role::where('name',$adminRoleName)->first();
        if(!$adminRole){
            $adminRole = new Role();
            $adminRole->name         = $adminRoleName;
            $adminRole->save();
        }
        //Create admin user
        $adminUserEmail = 'admin@admin.com';
        $adminUserPassword = 'admin';
        $adminUser = User::where('email',$adminUserEmail)->first();
        if(!$adminUser){
            $adminUser = new User();
            $adminUser->email = $adminUserEmail;
            $adminUser->password = Hash::make($adminUserPassword);
            $adminUser->save();
        }
        //Attach Role to User
        $adminUser->detachRoles($adminUser->roles);
        $adminUser->attachRole($adminRole);
    }
}
