<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'first_name' => 'Mr.',
            'last_name' => 'Super Admin',
            'email' => 'superadmin@email.com',
            'username' => 'super45',
            'phone_code' => null,
            'phone' => null,
            'password' => Hash::make('12345678'),
            'role' => SUPER_ADMIN_ROLE,
            'email_verification_code' => null,
            'verification_status' => USER_ACTIVE_STATUS
        ]);

        User::create([
            'first_name' => 'Mr.',
            'last_name' => 'Admin6',
            'email' => 'admin66@email.com',
            'username' => 'admin66',
            'phone_code' => null,
            'phone' => null,
            'password' => Hash::make('12345678'),
            'role' => ADMIN_ROLE,
            'email_verification_code' => null,
            'verification_status' => USER_ACTIVE_STATUS
        ]);

        User::create([
            'first_name' => 'Mr.',
            'last_name' => 'Admin7',
            'email' => 'admin77@email.com',
            'username' => 'admin77',
            'phone_code' => null,
            'phone' => null,
            'password' => Hash::make('12345678'),
            'role' => ADMIN_ROLE,
            'email_verification_code' => null,
            'verification_status' => USER_ACTIVE_STATUS
        ]);

        User::create([
            'first_name' => 'Mr.',
            'last_name' => 'User',
            'email' => 'user@email.com',
            'username' => 'user88',
            'phone_code' => null,
            'phone' => null,
            'password' => Hash::make('12345678'),
            'role' => USER_ROLE,
            'email_verification_code' => null,
            'verification_status' => USER_ACTIVE_STATUS
        ]);
    }
}
