<?php

namespace Database\Seeders;

use DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = DB::table('users')->insertGetId([
            'full_name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('TesPassword123'),
            'role' => 'admin',
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

        DB::table('admins')->insert([
            'user_id' => $userId,
            'job_title_id' => 2,
            'address' => '123 Admin St, Admin City, Admin State, 12345',
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);

        $faker = Faker::create();
        for ($i = 0; $i < 15; $i++) {
            $this->costumeFactory($faker);
        }
    }

    /**
     * Factory on method
     * @param mixed $faker
     * @return void
     */
    public function costumeFactory($faker): void
    {
        $userId = DB::table('users')->insertGetId([
            'full_name' => $faker->name,
            'email' => $faker->unique()->safeEmail,
            'password' => Hash::make('TesPassword123'),
            'role' => 'admin',
            'gender' => $faker->randomElement(['male', 'female']),
            'profile_picture' => null,
            'phone_number' => $faker->phoneNumber,
            'birth_date' => $faker->date('Y-m-d', '2000-01-01'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);

        DB::table('admins')->insert([
            'user_id' => $userId,
            'job_title_id' => $faker->numberBetween(3, 10),
            'address' => $faker->address,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);
    }
}
