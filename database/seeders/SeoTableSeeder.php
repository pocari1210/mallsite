<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SeoTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('seos')->insert([
      [
        'id' => 1,
        'meta_title' => 'mallsite online shop',
        'meta_author' => 'Testさん',
        'meta_keyword' => 'best tshirt, best shop',
        'meta_description' => 'ネットショップ構築の自己学習',
      ],
    ]);
  }
}
