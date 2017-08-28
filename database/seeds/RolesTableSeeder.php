<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
   * Seed the Roles table.
   *
   * @return void
   */
  public function run()
  {
      DB::statement('SET FOREIGN_KEY_CHECKS = 0');
      Role::truncate();
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');

      Role::create(['name' => 'administrator']);
  }
}
