<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call(UsersTableSeeder::class);
    $this->call(CategoriesTableSeeder::class);
    $this->call(SubCategoriesTableSeeder::class);
    $this->call(BrandsTableSeeder::class);
    $this->call(PermissionsTableSeeder::class);
    $this->call(RolesTableSeeder::class);
    $this->call(RoleHasPermissionsTableSeeder::class);
    $this->call(SeoTableSeeder::class);
    $this->call(SiteSettingTableSeeder::class);

    \App\Models\User::factory(8)->create();
    // \App\Models\User::factory(10)->create();

    // \App\Models\User::factory()->create([
    //     'name' => 'Test User',
    //     'email' => 'test@example.com',
    // ]);
  }
}
