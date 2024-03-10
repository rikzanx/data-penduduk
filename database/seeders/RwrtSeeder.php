<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RwrtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jumlah_rw = 5;
        $jumlah_rt = 5;
        for($i=1;$i<=$jumlah_rw;$i++){
            \App\Models\Rw::create([
                'name' => str_pad($i, 3, '0', STR_PAD_LEFT)
            ]);
        }
        for($i=1;$i<=$jumlah_rt;$i++){
            \App\Models\Rt::create([
                'name' => str_pad($i, 3, '0', STR_PAD_LEFT)
            ]);
        }
    }
}