<?php

namespace Database\Seeders;

use DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = DB::table('users')->insertGetId([
            'full_name' => 'Member User',
            'email' => 'member@example.com',
            'password' => Hash::make('TesMember123'),
            'role' => 'member',
            'gender' => 'male',
            'profile_picture' => null,
            'phone_number' => '1234567890',
            'birth_date' => '1990-01-01',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);

        DB::table('members')->insert([
            'user_id' => $userId,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);
    }
}
