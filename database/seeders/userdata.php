<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class userdata extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = now();
        DB::table('data_user')->insert([
            [
                'nama' => 'Admin',
                'username' => 'admin',
                'p4ssw0rd' => Hash::make('admin'),
                'role' => 'admin',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'nama' => 'Ketua Takmir',
                'username' => 'ketuatakmir',
                'p4ssw0rd' => Hash::make('ketuatakmir'),
                'role' => 'ketua',
                'created_at' => $date,
                'updated_at' => $date,
            ],
            [
                'nama' => 'Bendahara Takmir',
                'username' => 'bendaharatakmir',
                'p4ssw0rd' => Hash::make('bendaharatakmir'),
                'role' => 'bendahara',
                'created_at' => $date,
                'updated_at' => $date,
            ],
        ]);
    }
}
