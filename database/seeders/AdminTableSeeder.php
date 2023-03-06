<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\Roles;
use App\Models\User;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = ['superadmin','company','user','admin'];

        foreach($roles as $role_key => $role_value){
            $check_role = Roles::where('key',$role_value)->first();
            if(!$check_role){
                $add_role = new Roles();
                $add_role->key = $role_value;
                $add_role->name = $role_value;
                $add_role->role_status = 1;
                $add_role->save();
            }
        }
        $find_user = User::where(['email'=>'admin@park.com'])->first();
        $user = $find_user ?? new User();
        $user->email = 'admin@park.com';
        $user->password = Hash::make('park@123');
        $user->name = 'Super Admin';
        if($user->save()){
            $role = Roles::where('key','superadmin')->first();
            if(!$user->hasRole('superadmin')){
                $user->roles()->attach($role);
            }
        }
    }
}
