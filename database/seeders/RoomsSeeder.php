<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rooms = [
            [
                'id' => Str::uuid(),
                'name' => 'Ruang Rapat Besar',
                'description' => 'Ruang rapat utama dengan fasilitas proyektor dan kapasitas besar.',
                'capacity' => 50,
                'location' => 'Lantai 1 - Gedung Utama',
                'image' => 'rooms/rapat-besar.jpg',
                'property' => 'Proyektor, AC, Whiteboard',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Ruang Meeting Kecil',
                'description' => 'Cocok untuk meeting kecil dan diskusi tim.',
                'capacity' => 10,
                'location' => 'Lantai 2 - Gedung A',
                'image' => 'rooms/meeting-kecil.jpg',
                'property' => 'TV, AC',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Aula Serbaguna',
                'description' => 'Bisa digunakan untuk acara besar, seminar, atau pelatihan.',
                'capacity' => 200,
                'location' => 'Lantai 1 - Gedung B',
                'image' => 'rooms/aula.jpg',
                'property' => 'Sound System, Panggung, AC',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Ruang Presentasi',
                'description' => 'Dilengkapi layar besar dan sound system untuk presentasi.',
                'capacity' => 30,
                'location' => 'Lantai 3 - Gedung A',
                'image' => 'rooms/presentasi.jpg',
                'property' => 'Proyektor, Sound System, AC',
            ],
        ];

        DB::table('rooms')->insert($rooms);
    }
}
