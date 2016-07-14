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
      Role::truncate();

      Role::create(['name' => 'administrator']);
  }
}
