<?php

namespace Database\Seeders;

use App\User;
use Database\Seeders\AdminSeeder;
use Database\Seeders\TeacherSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
        ]);
    }
}
