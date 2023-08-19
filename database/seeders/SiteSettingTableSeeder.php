<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class SiteSettingTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('site_settings')->insert([
      [
        'id' => 1,
        'logo' => 'upload/logo/logo.png',
        'support_phone' => '0957-26-1785',
        'phone_one' => '0957-26-1785',
        'email' => 'Support@test.com',
        'company_address' => '長崎県諫早市永昌町1-1',
      ],
    ]);
  }
}
