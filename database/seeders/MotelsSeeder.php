<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MotelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $motels = DB::table('motels')->insert([
                'title' => 'Cho thue phong tro tai phong dinh cang thanh pho vinh',
                'area' => '12',
                'price' => '2300000',
        ]);
    }
}
