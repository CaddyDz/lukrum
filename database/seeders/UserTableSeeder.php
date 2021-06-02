<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();
        User::create(
            [
                'name'              => 'Admin admin',
                'first_name'        => 'Admin',
                'last_name'         => 'admin',
                'type'              => 'admin',
                'email'             => 'noreply@dms.partners',
                'password'          => Hash::make('admin123'),
                'email_verified_at' => Carbon::now()
            ]
        );

        // internal admin
        User::create(
            [
                'name'              => 'Internal admin',
                'first_name'        => 'Admin',
                'last_name'         => 'admin',
                'type'              => 'T/F',
                'email'             => 'noreply@admin.lukrum',
                'password'          => Hash::make('admin123'),
                'email_verified_at' => Carbon::now()
            ]
        );
    }
}
