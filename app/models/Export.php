<?php

class Export extends Eloquent {

  public static function submitted_blank_rec_query()
  {
    $results = DB::select('SELECT u.id, u.first_name, u.last_name, u.email
                           FROM applications a
                           INNER JOIN recommendations r on r.application_id = a.id
                           INNER JOIN users u on u.id = a.user_id
                           WHERE a.submitted = 1
                           AND r.rank_character IS null
                           AND a.completed IS null');
    return $results;
  }

  public static function submitted_no_rec_query()
  {
    $results = DB::select('SELECT u.id, u.first_name, u.last_name, u.email
                           FROM applications a
                           INNER JOIN users u on u.id = a.user_id
                           WHERE a.submitted = 1
                           AND not exists (SELECT *
                                           FROM recommendations r
                                           WHERE r.application_id = a.id)');

    return $results;
  }

  public static function incomplete_apps_query()
  {
    $results = DB::select('SELECT u.id, u.first_name, u.last_name, u.email
                           FROM applications a
                           INNER JOIN users u on u.id = a.user_id
                           WHERE a.submitted is null');

    return $results;
  }

  public static function nominated_no_app_query()
  {
    $results = DB::select('SELECT n.nom_name, n.nom_email
                           FROM nominations n
                           WHERE not exists (SELECT *
                                             FROM users u
                                             WHERE n.nom_email = u.email)');
    return $results;
  }

  public static function completed_apps_query()
  {
    $results = DB::select('SELECT u.id, u.first_name, u.last_name, u.email
                          FROM applications a
                          INNER JOIN users u on u.id = a.user_id
                          WHERE a.completed = 1
                          AND a.submitted = 1');

    return $results;

  }
}