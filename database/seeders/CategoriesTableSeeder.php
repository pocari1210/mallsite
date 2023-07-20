<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CategoriesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('categories')->insert([
      [
        'id' => '1',
        'category_name' => 'Fashion',
        'category_slug' => 'fashion',
        'category_image' => Null,
      ],
      [
        'id' => '2',
        'category_name' => 'Electronics',
        'category_slug' => 'electronics',
        'category_image' => Null,
      ],
      [
        'id' => '3',
        'category_name' => 'Sweet Home',
        'category_slug' => 'sweet-home',
        'category_image' => Null,
      ],
      [
        'id' => '4',
        'category_name' => 'Appliances',
        'category_slug' => 'appliances',
        'category_image' => Null,
      ],
      [
        'id' => '5',
        'category_name' => 'Beauty',
        'category_slug' => 'beauty',
        'category_image' => Null,
      ],
      [
        'id' => '6',
        'category_name' => 'Meat & Fish',
        'category_slug' => 'meat-&-fish',
        'category_image' => Null,
      ],
      [
        'id' => '7',
        'category_name' => 'Furniture',
        'category_slug' => 'furniture',
        'category_image' => Null,
      ],
      [
        'id' => '8',
        'category_name' => 'Mobiles',
        'category_slug' => 'mobiles',
        'category_image' => Null,
      ],
      [
        'id' => '9',
        'category_name' => 'Grocery',
        'category_slug' => 'grocery',
        'category_image' => Null,
      ],
      [
        'id' => '10',
        'category_name' => 'Travel',
        'category_slug' => 'travel',
        'category_image' => Null,
      ],

    ]);
  }
}
