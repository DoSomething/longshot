<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
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
        $results = DB::select('SELECT n.nom_name as Nominee, n.nom_email as Email
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
        $results = DB::select('SELECT r.first_name, r.last_name, r.relationship, r.phone, r.email, concat("/recommendation/", r.id, "/edit?token=", rt.token) as link, u.first_name as applicant_first_name, u.last_name as applicant_last_name
                          FROM recommendations r
                          INNER JOIN recommendation_tokens rt on r.id = rt.recommendation_id
                          INNER JOIN applications a on r.application_id = a.id
                          INNER JOIN users u on a.user_id = u.id
                          WHERE r.rank_character is null');

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
        $results = DB::select('SELECT DISTINCT first_name, email
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

    public static function yes_applicants_query()
    {
        //removes newlines (10 - line feed, 13 - carriage return), horizontal tabs (9), and replaces commas (44) with semicolons
    $results = DB::select('SELECT distinct concat(u.first_name, " ", u.last_name) as name, p.gender, p.state, p.zip, group_concat(r.race) as race,
                                            REPLACE(REPLACE(REPLACE(REPLACE(a.activities,CHAR(10)," "),CHAR(13)," "), CHAR(9)," "), CHAR(44),";"),
                                            concat("footlockerscholarathletes.com/admin/applications/", u.id) as link
                          FROM users u
                          INNER JOIN profiles p on p.user_id = u.id
                          INNER JOIN races r on r.profile_id = p.id
                          INNER JOIN applications a on a.user_id = u.id
                          INNER JOIN ratings s on s.application_id = a.id
                          WHERE s.rating = "yes"
                          GROUP BY name
                          ORDER BY name');

        return $results;
    }
}
