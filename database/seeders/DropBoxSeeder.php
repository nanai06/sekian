<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DropBoxSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('drop_boxes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $dropBoxes = [
            [
                'nama_lokasi' => 'Alfamart Sudirman',
                'alamat'      => 'Jl. Jend. Sudirman No. 45, Jakarta Pusat',
                'qr_code'     => 'AYUNE-DB-001',
                'aktif'       => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_lokasi' => 'Indomaret Thamrin',
                'alamat'      => 'Jl. M.H. Thamrin No. 12, Jakarta Pusat',
                'qr_code'     => 'AYUNE-DB-002',
                'aktif'       => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_lokasi' => 'Guardian Grand Indonesia',
                'alamat'      => 'Jl. M.H. Thamrin No. 1, Jakarta Pusat',
                'qr_code'     => 'AYUNE-DB-003',
                'aktif'       => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_lokasi' => 'Lottemart Bintaro',
                'alamat'      => 'Jl. RC. Veteran Raya No. 2, Bintaro',
                'qr_code'     => 'AYUNE-DB-004',
                'aktif'       => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'nama_lokasi' => 'Minimarket Kampus UI Depok',
                'alamat'      => 'Jl. Universitas No. 1, Depok',
                'qr_code'     => 'AYUNE-DB-005',
                'aktif'       => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];

        DB::table('drop_boxes')->insert($dropBoxes);
    }
}
