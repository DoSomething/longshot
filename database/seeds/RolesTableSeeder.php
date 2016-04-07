<?php

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
