<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate(
            ['email' => 'test@email.com'],
            [
                'name' => 'test user',
                'email' => 'test@email.com',
                'password' => bcrypt(123456789)
            ]
        );
        $token = $user->createToken('test')->plainTextToken;

        $this->command->info("User token: {$token}");
    }
}
