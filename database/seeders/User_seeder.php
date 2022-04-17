<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class User_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;

        $user->email = 'superadmin@superadmin.com';
        $user->name = 'Super Admin';
        $user->password = Hash::make('superadmin');
        $user->assignRole('super_admin');
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->save();
        // DB::table('users')->insert(

    }
}
