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

  public static function rec_requested_not_finished_query()
  {
    $results = DB::select('SELECT first_name, last_name, relationship, phone, email
                          FROM recommendations r
                          WHERE rank_character is null');

    return $results;
  }

  public static function nominators_query()
  {
    $results = DB::select('SELECT DISTINCT rec_name as Name, rec_email as Email
                          FROM nominations');

    return $results;
  }

  public static function nominees_query()
  {
    $results = DB::select('SELECT DISTINCT nom_name as Name, nom_email as Email
                          FROM nominations');

    return $results;
  }

  public static function recommenders_query()
  {
    $results = DB::select('SELECT first_name, email
                          FROM recommendations
                          WHERE rank_character IS NOT null');

    return $results;
  }

  public static function completed_apps_by_first_and_email_query()
  {
    $results = DB::select('SELECT u.first_name, u.email
                          FROM applications a
                          INNER JOIN users u on u.id = a.user_id
                          WHERE a.completed = 1
                          AND a.submitted = 1');

    return $results;
  }

  public static function incomplete_apps_by_first_and_email_query()
  {
    $results = DB::select('SELECT u.first_name, u.email
                          FROM applications a
                          INNER JOIN users u on u.id = a.user_id
                          WHERE a.submitted = 1
                          AND a.completed = null');

    return $results;
  }
}
