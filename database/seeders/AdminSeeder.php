<?php

namespace Database\Seeders;
use Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::where('role','admin')->delete();
        $pwd = Hash::make('admin123');
        $admin = User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => $pwd,
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
