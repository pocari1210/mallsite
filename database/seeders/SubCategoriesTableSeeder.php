<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SubCategoriesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('sub_categories')->insert([
      [
        'id' => '1',
        'category_id' => '1',
        'subcategory_name' => 'Women Bottom Ware',
        'subcategory_slug' => 'women-bottom-ware',
      ],
      [
        'id' => '2',
        'category_id' => '1',
        'subcategory_name' => 'Mans Bottom Ware',
        'subcategory_slug' => 'mans-bottom-ware',
      ],
      [
        'id' => '3',
        'category_id' => '2',
        'subcategory_name' => 'Computer Peripherals',
        'subcategory_slug' => 'computer-peripherals',
      ],
      [
        'id' => '4',
        'category_id' => '2',
        'subcategory_name' => 'Mobile Accessory',
        'subcategory_slug' => 'mobile-accessory',
      ],
      [
        'id' => '5',
        'category_id' => '3',
        'subcategory_name' => 'Home Furnishings',
        'subcategory_slug' => 'home-furnishings',
      ],
      [
        'id' => '6',
        'category_id' => '1',
        'subcategory_name' => 'Mans Top Ware',
        'subcategory_slug' => 'mans-top-ware',
      ],
      [
        'id' => '7',
        'category_id' => '1',
        'subcategory_name' => 'Women Footwear',
        'subcategory_slug' => 'women-footwear',
      ],
      [
        'id' => '8',
        'category_id' => '3',
        'subcategory_name' => 'Living Room',
        'subcategory_slug' => 'living-room',
      ],
      [
        'id' => '9',
        'category_id' => '3',
        'subcategory_name' => 'Home Decor',
        'subcategory_slug' => 'home-decor',
      ],
      [
        'id' => '10',
        'category_id' => '4',
        'subcategory_name' => 'Televisions',
        'subcategory_slug' => 'televisions',
      ],
      [
        'id' => '11',
        'category_id' => '4',
        'subcategory_name' => 'Televisions',
        'subcategory_slug' => 'televisions',
      ],
      [
        'id' => '12',
        'category_id' => '4',
        'subcategory_name' => 'Refrigerators',
        'subcategory_slug' => 'refrigerators',
      ],
      [
        'id' => '13',
        'category_id' => '9',
        'subcategory_name' => 'Apple',
        'subcategory_slug' => 'apple',
      ],
      [
        'id' => '14',
        'category_id' => '9',
        'subcategory_name' => 'Samsung',
        'subcategory_slug' => 'samsung',
      ],
      [
        'id' => '15',
        'category_id' => '9',
        'subcategory_name' => 'OPPO',
        'subcategory_slug' => 'oppo',
      ],
      [
        'id' => '16',
        'category_id' => '5',
        'subcategory_name' => 'Woman Mackup',
        'subcategory_slug' => 'woman-mackup',
      ],
    ]);
  }
}
