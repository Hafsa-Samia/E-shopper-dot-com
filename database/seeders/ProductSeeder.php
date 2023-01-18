<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('products')->delete();
        DB::table('products')->insert([
            'name' => 'Singer Kettle',
            'price' => '1300',
            'category' => 'Electronics',
            'description' => 'Capacity 1.7ml, Thermal Protection, Concealed Heating Element,
            Indicator light, Automatic cut off, Water',
            'gallery' => '/image/kettle.jpeg'
        ]);

        DB::table('products')->insert([
            'name' => 'Oppo F21 Pro',
            'price' => '29,990',
            'category' => 'Electronics',
            'description' => 'Dual Nano SIM,Wi-Fi direct,Punch-hole,32 Megapixel,8 GB',
            'gallery' => '/image/oppo.jpeg'
        ]);

        DB::table('products')->insert([
            'name' => 'Wrist Watch',
            'price' => '500',
            'category' => 'Electronics',
            'description' => 'Fashionable, Ultra Thin, Business Stainless Steel Mesh Quartz Watch',
            'gallery' => '/image/watch.jpeg'
        ]);
    }
}
