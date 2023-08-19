<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BrandsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('brands')->insert([
      [
        'id' => '1',
        'brand_name' => 'Oppo',
        'brand_slug' => 'oppo',
      ],
      [
        'id' => '2',
        'brand_name' => 'Waltan',
        'brand_slug' => 'waltan',
      ],
      [
        'id' => '3',
        'brand_name' => 'Bata',
        'brand_slug' => 'bata',
      ],

    ]);
  }
}
