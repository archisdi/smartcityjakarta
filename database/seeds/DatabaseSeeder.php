<?php

use Illuminate\Database\Seeder;
use App\Models\JenisRs;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['username' => 'archisdiningrat','name' => 'AAI','password' => bcrypt('becauseofyou')]);

        JenisRs::create(['nama' => 'Rs umum']);
        JenisRs::create(['nama' => 'Rs khusus']);
        JenisRs::create(['nama' => 'Puskesmas']);
    }
}
