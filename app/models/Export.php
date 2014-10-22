<?php

class Export extends Eloquent {

  public static function blank_rec_query() {
    $blank_rec_results = DB::select('SELECT u.id, u.first_name, u.last_name, u.email
                                     FROM applications a
                                     INNER JOIN recommendations r on r.application_id = a.id
                                     INNER JOIN users u on u.id = a.user_id
                                     WHERE a.submitted = 1
                                     AND r.rank_character IS null');
    return $blank_rec_results;
  }
}