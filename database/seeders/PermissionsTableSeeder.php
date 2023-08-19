<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class PermissionsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('permissions')->insert([
      [
        'id' => '1',
        'name' => 'brand.menu',
        'guard_name' => 'web',
        'group_name' => 'brand',
      ],
      [
        'id' => '2',
        'name' => 'brand.list',
        'guard_name' => 'web',
        'group_name' => 'brand',
      ],
      [
        'id' => '3',
        'name' => 'brand.add',
        'guard_name' => 'web',
        'group_name' => 'brand',
      ],
      [
        'id' => '4',
        'name' => 'brand.edit',
        'guard_name' => 'web',
        'group_name' => 'brand',
      ],
      [
        'id' => '5',
        'name' => 'brand.delete',
        'guard_name' => 'web',
        'group_name' => 'brand',
      ],
      [
        'id' => '6',
        'name' => 'category.menu',
        'guard_name' => 'web',
        'group_name' => 'category',
      ],
      [
        'id' => '8',
        'name' => 'category.list',
        'guard_name' => 'web',
        'group_name' => 'category',
      ],
      [
        'id' => '9',
        'name' => 'category.add',
        'guard_name' => 'web',
        'group_name' => 'category',
      ],
      [
        'id' => '10',
        'name' => 'category.edit',
        'guard_name' => 'web',
        'group_name' => 'category',
      ],
      [
        'id' => '11',
        'name' => 'category.delete',
        'guard_name' => 'web',
        'group_name' => 'category',
      ],
      [
        'id' => '12',
        'name' => 'subcategory.menu',
        'guard_name' => 'web',
        'group_name' => 'subcategory',
      ],
      [
        'id' => '13',
        'name' => 'subcategory.list',
        'guard_name' => 'web',
        'group_name' => 'subcategory',
      ],
      [
        'id' => '14',
        'name' => 'subcategory.add',
        'guard_name' => 'web',
        'group_name' => 'subcategory',
      ],
      [
        'id' => '15',
        'name' => 'subcategory.edit',
        'guard_name' => 'web',
        'group_name' => 'subcategory',
      ],
      [
        'id' => '16',
        'name' => 'subcategory.delete',
        'guard_name' => 'web',
        'group_name' => 'subcategory',
      ],
      [
        'id' => '17',
        'name' => 'product.menu',
        'guard_name' => 'web',
        'group_name' => 'product',
      ],
      [
        'id' => '18',
        'name' => 'product.list',
        'guard_name' => 'web',
        'group_name' => 'product',
      ],
      [
        'id' => '19',
        'name' => 'product.add',
        'guard_name' => 'web',
        'group_name' => 'product',
      ],
      [
        'id' => '20',
        'name' => 'product.edit',
        'guard_name' => 'web',
        'group_name' => 'product',
      ],
      [
        'id' => '21',
        'name' => 'product.delete',
        'guard_name' => 'web',
        'group_name' => 'product',
      ],
      [
        'id' => '22',
        'name' => 'slider.menu',
        'guard_name' => 'web',
        'group_name' => 'slider',
      ],
      [
        'id' => '23',
        'name' => 'slider.list',
        'guard_name' => 'web',
        'group_name' => 'slider',
      ],
      [
        'id' => '24',
        'name' => 'slider.add',
        'guard_name' => 'web',
        'group_name' => 'slider',
      ],
      [
        'id' => '25',
        'name' => 'slider.edit',
        'guard_name' => 'web',
        'group_name' => 'slider',
      ],
      [
        'id' => '26',
        'name' => 'slider.delete',
        'guard_name' => 'web',
        'group_name' => 'slider',
      ],
      [
        'id' => '27',
        'name' => 'ads.menu',
        'guard_name' => 'web',
        'group_name' => 'ads',
      ],
      [
        'id' => '28',
        'name' => 'ads.list',
        'guard_name' => 'web',
        'group_name' => 'ads',
      ],
      [
        'id' => '29',
        'name' => 'ads.add',
        'guard_name' => 'web',
        'group_name' => 'ads',
      ],
      [
        'id' => '30',
        'name' => 'ads.edit',
        'guard_name' => 'web',
        'group_name' => 'ads',
      ],
      [
        'id' => '31',
        'name' => 'ads.delete',
        'guard_name' => 'web',
        'group_name' => 'ads',
      ],
      [
        'id' => '32',
        'name' => 'coupon.menu',
        'guard_name' => 'web',
        'group_name' => 'coupon',
      ],
      [
        'id' => '33',
        'name' => 'coupon.list',
        'guard_name' => 'web',
        'group_name' => 'coupon',
      ],
      [
        'id' => '34',
        'name' => 'coupon.add',
        'guard_name' => 'web',
        'group_name' => 'coupon',
      ],
      [
        'id' => '35',
        'name' => 'coupon.edit',
        'guard_name' => 'web',
        'group_name' => 'coupon',
      ],
      [
        'id' => '36',
        'name' => 'coupon.delete',
        'guard_name' => 'web',
        'group_name' => 'coupon',
      ],
      [
        'id' => '37',
        'name' => 'area.menu',
        'guard_name' => 'web',
        'group_name' => 'area',
      ],
      [
        'id' => '38',
        'name' => 'vendor.menu',
        'guard_name' => 'web',
        'group_name' => 'vendor',
      ],
      [
        'id' => '39',
        'name' => 'order.menu',
        'guard_name' => 'web',
        'group_name' => 'order',
      ],
      [
        'id' => '40',
        'name' => 'order.list',
        'guard_name' => 'web',
        'group_name' => 'order',
      ],
      [
        'id' => '41',
        'name' => 'return.order.menu',
        'guard_name' => 'web',
        'group_name' => 'return',
      ],
      [
        'id' => '42',
        'name' => 'user.management.menu',
        'guard_name' => 'web',
        'group_name' => 'user',
      ],
      [
        'id' => '43',
        'name' => 'review.menu',
        'guard_name' => 'web',
        'group_name' => 'review',
      ],
      [
        'id' => '44',
        'name' => 'blog.menu',
        'guard_name' => 'web',
        'group_name' => 'blog',
      ],
      [
        'id' => '45',
        'name' => 'site.menu',
        'guard_name' => 'web',
        'group_name' => 'setting',
      ],
      [
        'id' => '46',
        'name' => 'role.permission.menu',
        'guard_name' => 'web',
        'group_name' => 'role',
      ],
      [
        'id' => '47',
        'name' => 'admin.user.menu',
        'guard_name' => 'web',
        'group_name' => 'admin',
      ],
      [
        'id' => '48',
        'name' => 'stock.menu',
        'guard_name' => 'web',
        'group_name' => 'stock',
      ],
      [
        'id' => '49',
        'name' => 'report.menu',
        'guard_name' => 'web',
        'group_name' => 'report',
      ],


    ]);
  }
}
