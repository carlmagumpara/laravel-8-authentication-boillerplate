<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Helpers\Utils;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = '09071995';
        $verified = Carbon::now();

        $data = [
            [
                'is_super' => 1,
                'role_id' => 1,
                'status' => 'Active',
                'first_name' => 'Test',
                'last_name' => 'Admin',
                'photo' => null,
                'email' => 'admin@gmail.com',
                'password' => Hash::make($password),
                'email_verified_at' => $verified,
            ],
            [
                'role_id' => 2,
                'status' => 'Active',
                'first_name' => 'Test',
                'last_name' => 'Staff',
                'photo' => null,
                'email' => 'staff@gmail.com',
                'password' => Hash::make($password),
                'email_verified_at' => $verified,
            ],
            [
                'role_id' => 3,
                'status' => 'Active',
                'first_name' => 'Test',
                'last_name' => 'User',
                'photo' => null,
                'email' => 'user@gmail.com',
                'password' => Hash::make($password),
                'email_verified_at' => $verified,
            ],
        ];

        for ($i = 0; $i < count($data); $i++) {
            $user = User::create($data[$i]);
        }
    }
}
