<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Kita panggil seeder yang sudah kita pecah-pecah sebelumnya
        // Ini jauh lebih rapi dan gampang dikelola
        $this->call([
            UserSeeder::class,
            AcademicSeeder::class,
            RoomSeeder::class,
        ]);
    }
}
