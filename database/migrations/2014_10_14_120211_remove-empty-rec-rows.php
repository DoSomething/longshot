<?php

use Illuminate\Database\Migrations\Migration;

class RemoveEmptyRecRows extends Migration
{
    /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      DB::statement("DELETE r.*, rt.*
                   FROM recommendations r
                   INNER JOIN recommendation_tokens rt on rt.recommendation_id = r.id
                   WHERE r.first_name LIKE '';");
  }

    public function down()
    {
        // Irreversible!
    }
}
