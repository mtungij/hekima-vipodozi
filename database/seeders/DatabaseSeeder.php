<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Company;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Company::factory()->create([
            'name' => 'HEKIMA BEAUTY SHOP',
            'address' => 'P.O.BOX 295, Uyole, Mbeya',
            'email' => 'hekimabeauty@gmail.com',
            'phone' => '076000000000',
        ]);
    
        Branch::factory()->create([
            'company_id' => 1,
            'name' => 'HEKIMA BEAUTY SHOP',
            'address' => 'P.O.BOX 295, Uyole, Mbeya',
            'phone' => '076000000000',
        ]);
    
        User::factory()->create([
            'branch_id' => 1,
            'company_id' => 1,
            'name' => 'Mwanze',
            'email' => 'mwanze@gmail.com',
            'role' => 'admin',
            'phone' => '07600000000',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);
    
        // Add another user
        User::factory()->create([
            'branch_id' => 1,
            'company_id' => 1,
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'role' => 'admin',
            'phone' => '07550000000',
            'email_verified_at' => now(),
            'password' => Hash::make('password1234'),
            'remember_token' => Str::random(10)
        ]);
    }
    
}
