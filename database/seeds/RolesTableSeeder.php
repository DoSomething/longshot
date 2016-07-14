<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
   * Seed the Roles table.
   *
   * @return void
   */
  public function run()
  {
      Role::truncate();

      Role::create(['name' => 'administrator']);
  }
}
