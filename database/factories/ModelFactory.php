<?php
use Faker\Generator;
use App\Models\Profile;

/**
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

// user
// user with partial profile (including race)
// user with partial profile (no race)
// user with partial profile and partial app
// user with finished profile
// user with finished profile and partial app
// user with finished profile and submitted app and rec requests
// user with finished profile, completed app, completed rec requests



// User Factory
        // need:
        // first_name
        // last_name
$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

// Profile Factory
    // birthdate
    // phone
    // address_street
    // address_premise
    // city
    // state
    // zip
    // gender
    // school
    // grade
$factory->define(Profile::class, function (Generator $faker) {
    return [
        'birthdate' => $faker->dateTimeInInterval($startDate = '-18 years', $interval = '+1 years')->format('Y-m-d'),
        'phone' => $faker->phoneNumber,
        'address_street' => null,
        'address_premise' => null,
        'city' => null,
        'state' => null,
        'zip' => null,
        'gender' => null,
        'school' => null,
        'grade' => null,
    ];
});


// Partial Profile factory
    // birthdate
    // phone

// Races (goes with profile and partial profile)
    // profile_id
    // race

// Applications (need some partial)
    // scholarship_id
    // accomplishments
    // activities
    // participation
    // essay1
    // essay2
    // hear_about
    // test_type
    // test_score
    // gpa

// submitted app
    // scholarship_id
    // accomplishments
    // activities
    // participation
    // essay1
    // essay2
    // hear_about
    // test_type
    // test_score
    // gpa
    // submitted

// completed app
    // scholarship_id
    // accomplishments
    // activities
    // participation
    // essay1
    // essay2
    // hear_about
    // test_type
    // test_score
    // gpa
    // submitted
    // completed

// partial app
    // scholarship_id
    // accomplishments
    // activities

// Recommendation Requests
    // application_id
    // first_name
    // last_name
    // relationship
    // phone
    // email

// Completed Recommendations
    // application_id
    // first_name
    // last_name
    // relationship
    // phone
    // email
    // rank_character
    // rank_additional
    // essay1
