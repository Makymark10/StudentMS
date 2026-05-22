<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed standard users
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@studentms.com',
        ]);

        // Seed some sample students for the midterm project
        Student::create([
            'name' => 'Alice Margareth',
            'email' => 'alice@studentms.com',
            'age' => 20,
        ]);

        Student::create([
            'name' => 'John Denver',
            'email' => 'john.denver@studentms.com',
            'age' => 22,
        ]);

        Student::create([
            'name' => 'Sofia Lorenzo',
            'email' => 'sofia.lorenzo@studentms.com',
            'age' => 21,
        ]);

        Student::create([
            'name' => 'Marcus Aurelius',
            'email' => 'marcus@studentms.com',
            'age' => 23,
        ]);
    }
}
