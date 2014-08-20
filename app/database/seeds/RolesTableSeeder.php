<?php

class RolesTableSeeder extends Seeder {

  /**
   * Seed the Roles table.
   *
   * @return void
   */
  public function run()
  {
    // @TODO: can't truncate since this model has a foreign key constraint... figure this out, because it would be ideal.
    // Role::truncate();

    Role::create(['name' => 'administrator']);
    Role::create(['name' => 'applicant']);
  }

}
