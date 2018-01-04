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
        $results = DB::select('SELECT n.nom_name, n.nom_email as email
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
        $results = DB::select('SELECT DISTINCT rec_name as Name, rec_email as email
                          FROM nominations');

        return $results;
    }

    public static function nominees_query()
    {
        $results = DB::select('SELECT DISTINCT nom_name as Name, nom_email as email
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

    public static function demo_data_query()
    {
        $results = DB::select('SELECT u.first_name, u.last_name, p.city, p.state, p.zip, p.gender, p.school, a.hear_about, a.test_type, a.test_score, a.gpa, group_concat(r.race) as race
                          FROM users u
                          LEFT JOIN applications a on u.id = a.user_id
                          LEFT JOIN profiles p on u.id = p.user_id
                          LEFT JOIN races r on p.id = r.profile_id
                          GROUP BY u.email');

        return $results;
    }

    public static function full_yes_data_query()
    {
        $results = DB::select('SELECT u.first_name, u.last_name, u.email,
                          p.birthdate, p.phone, p.address_street, p.address_premise, p.city, p.state, p.zip, p.gender, p.school, p.grade,
                          a.accomplishments, a.activities, a.participation, a.essay1, a.essay2, a.extra_question_1, a.extra_question_2, a.extra_question_3, a.extra_question_4, a.extra_question_5, a.hear_about, a.test_type, a.test_score, a.gpa,
                          group_concat(r.race) as race,

                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.first_name SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation First Name 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.last_name SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation Last Name 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.relationship SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation Relationship 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.phone SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation Phone 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.email SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation Email 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_character SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation rank_character 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_additional SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation rank_additional 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.essay1 SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation essay 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.optional_question SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation optional question 1",

                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.first_name SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation First Name 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.last_name SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation Last Name 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.relationship SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation Relationship 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.phone SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation Phone 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.email SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation Email 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_character SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation rank_character 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_additional SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation rank_additional 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.essay1 SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation essay 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.optional_question SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation optional question 2",

                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.first_name SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation First Name 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.last_name SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation Last Name 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.relationship SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation Relationship 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.phone SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation Phone 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.email SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation Email 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_character SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation rank_character 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_additional SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation rank_additional 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.essay1 SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation essay 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.optional_question SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation optional question 3",

                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.first_name SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation First Name 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.last_name SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation Last Name 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.relationship SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation Relationship 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.phone SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation Phone 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.email SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation Email 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_character SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation rank_character 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_additional SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation rank_additional 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.essay1 SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation essay 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.optional_question SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation optional question 4"

                          FROM users u
                          INNER JOIN profiles p on p.user_id = u.id
                          LEFT JOIN races r on r.profile_id = p.id
                          INNER JOIN applications a on a.user_id = u.id
                          INNER JOIN ratings s on s.application_id = a.id
                          LEFT JOIN recommendations recs on recs.application_id = a.id
                          WHERE s.rating = "yes"
                          GROUP BY u.email');

        return $results;
    }

    public static function full_app_data_query()
    {
        $results = DB::select('SELECT u.first_name, u.last_name, u.email,
                          p.birthdate, p.phone, p.address_street, p.address_premise, p.city, p.state, p.zip, p.gender, p.school, p.grade,
                          a.accomplishments, a.activities, a.participation, a.essay1, a.essay2, a.extra_question_1, a.extra_question_2, a.extra_question_3, a.extra_question_4, a.extra_question_5, a.hear_about, a.test_type, a.test_score, a.gpa,
                          group_concat(r.race) as race, s.rating,

                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.first_name SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation First Name 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.last_name SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation Last Name 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.relationship SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation Relationship 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.phone SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation Phone 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.email SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation Email 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_character SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation rank_character 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_additional SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation rank_additional 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.essay1 SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation essay 1",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.optional_question SEPARATOR "----"),"----"), "----", 1), "----", -1) AS "Recommendation optional question 1",

                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.first_name SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation First Name 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.last_name SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation Last Name 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.relationship SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation Relationship 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.phone SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation Phone 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.email SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation Email 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_character SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation rank_character 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_additional SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation rank_additional 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.essay1 SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation essay 2",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.optional_question SEPARATOR "----"),"----"), "----", 2), "----", -1) AS "Recommendation optional question 2",

                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.first_name SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation First Name 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.last_name SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation Last Name 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.relationship SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation Relationship 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.phone SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation Phone 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.email SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation Email 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_character SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation rank_character 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_additional SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation rank_additional 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.essay1 SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation essay 3",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.optional_question SEPARATOR "----"),"----"), "----", 3), "----", -1) AS "Recommendation optional question 3",

                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.first_name SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation First Name 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.last_name SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation Last Name 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.relationship SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation Relationship 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.phone SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation Phone 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.email SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation Email 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_character SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation rank_character 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.rank_additional SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation rank_additional 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.essay1 SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation essay 4",
                          SUBSTRING_INDEX(SUBSTRING_INDEX(CONCAT(GROUP_CONCAT(recs.optional_question SEPARATOR "----"),"----"), "----", 4), "----", -1) AS "Recommendation optional question 4"

                          FROM users u
                          LEFT JOIN profiles p on u.id = p.user_id
                          LEFT JOIN races r on r.profile_id = p.id
                          LEFT JOIN applications a on u.id = a.user_id
                          LEFT JOIN ratings s on a.id = s.application_id
                          LEFT JOIN recommendations recs on recs.application_id = a.id
                          GROUP BY u.email');

        return $results;
    }
}
