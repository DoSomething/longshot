<?php

use App\Models\Race;
use App\Models\User;
use Faker\Generator;
use App\Models\Profile;
use App\Models\Application;
use App\Models\Scholarship;
use App\Models\Recommendation;


/**
 * |--------------------------------------------------------------------------
 * | Model Factories
 * |--------------------------------------------------------------------------
 * |
 * | Here you may define all of your model factories. Model factories give
 * | you a convenient way to create models for testing and seeding your
 * | database. Just tell the factory how a default model should look.
 * |
 */

// User Factory
$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

// Profile Factories
$factory->define(Profile::class, function (Generator $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'birthdate' => $faker->dateTimeInInterval($startDate = '-18 years', $interval = '+1 years')->format('Y-m-d'),
        'phone' => $faker->randomNumber(9) . $faker->randomNumber(1),
        'address_street' => $faker->streetAddress(),
        'address_premise' => $faker->randomElement(['', '', $faker->secondaryAddress]),
        'city' => $faker->city,
        'state' => $faker->state,
        'zip' => $faker->randomNumber(5),
        'gender' => $faker->randomElement(['M', 'F']),
        'school' => $faker->firstNameFemale . ' ' . $faker->lastName . ' High School',
        'grade' => $faker->numberBetween(9, 12),
    ];
});

// Partial Profile factory
$factory->defineAs(Profile::class, 'partial', function (Generator $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'birthdate' => $faker->dateTimeInInterval($startDate = '-18 years', $interval = '+1 years')->format('Y-m-d'),
        'phone' => $faker->randomNumber(9) . $faker->randomNumber(1),
    ];
});

// Races (goes with profile and partial profile)
    // profile_id
$factory->define(Race::class, function (Generator $faker) {
    return [
        'race' => $faker->randomElement(['White', 'Black/African American', 'Hispanic/Latino/Spanish', 'Asian', 'American Indian or Alaska Native', 'Pacific Islander/Native Hawaiian', 'Other']),
    ];
});

// Application ("finished" but not submitted)
$factory->define(Application::class, function (Generator $faker) {
    return [
        'scholarship_id' => Scholarship::getCurrentScholarship()->id,
        'accomplishments' => $faker->paragraphs(4, true),
        'activities' => $faker->paragraph(5),
        'participation' => $faker->paragraph(5),
        'essay1' => $faker->paragraphs(6, true),
        'essay2' => $faker->paragraphs(6, true),
        'hear_about' => $faker->randomElement(['Online', 'Search Engine', 'Friend', '']),
        'test_type' => $faker->randomElement(['PSAT', 'ACT', 'SAT (1600)', 'SAT (2400)']),
        'test_score' => $faker->numberBetween(0, 2400),
        'gpa' => $faker->randomElement([3.0, 3.1, 3.2, 3.3, 3.4, 3.5, 3.6, 3.7, 3.8, 3.9, 4.0]),
    ];
});

// Submitted Application
    // user_id
$factory->defineAs(Application::class, 'submitted', function (Generator $faker) {
    return [
        'scholarship_id' => Scholarship::getCurrentScholarship()->id,
        'accomplishments' => $faker->paragraphs(4, true),
        'activities' => $faker->paragraph(5),
        'participation' => $faker->paragraph(5),
        'essay1' => $faker->paragraphs(6, true),
        'essay2' => $faker->paragraphs(6, true),
        'hear_about' => $faker->randomElement(['Online', 'Search Engine', 'Friend', '']),
        'test_type' => $faker->randomElement(['PSAT', 'ACT', 'SAT (1600)', 'SAT (2400)']),
        'test_score' => $faker->numberBetween(0, 2400),
        'gpa' => $faker->randomElement([3.0, 3.1, 3.2, 3.3, 3.4, 3.5, 3.6, 3.7, 3.8, 3.9, 4.0]),
        'submitted' => 1,
    ];
});

// Completed Application
$factory->defineAs(Application::class, 'completed', function (Generator $faker) {
    return [
        'scholarship_id' => Scholarship::getCurrentScholarship()->id,
        'accomplishments' => $faker->paragraphs(4, true),
        'activities' => $faker->paragraph(5),
        'participation' => $faker->paragraph(5),
        'essay1' => $faker->paragraphs(6, true),
        'essay2' => $faker->paragraphs(6, true),
        'hear_about' => $faker->randomElement(['Online', 'Search Engine', 'Friend', '']),
        'test_type' => $faker->randomElement(['PSAT', 'ACT', 'SAT (1600)', 'SAT (2400)']),
        'test_score' => $faker->numberBetween(0, 2400),
        'gpa' => $faker->randomElement([3.0, 3.1, 3.2, 3.3, 3.4, 3.5, 3.6, 3.7, 3.8, 3.9, 4.0]),
        'submitted' => 1,
        'completed' => 1,
    ];
});

// Partial Application
$factory->defineAs(Application::class, 'partial', function (Generator $faker) {
    return [
        'scholarship_id' => Scholarship::getCurrentScholarship()->id,
        'accomplishments' => $faker->paragraphs(4, true),
        'activities' => $faker->paragraph(5),
    ];
});

// Recommendation Requests
    // application_id
$factory->defineAs(Recommendation::class, 'request', function (Generator $faker) {
    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName,
        'relationship' => $faker->randomElement(['Teacher', 'Coach', 'Mentor', 'Band Director', 'Club Sponsor', 'Parent']),
        'phone' => $faker->randomNumber(9) . $faker->randomNumber(1),
        'email' => $faker->safeEmail,
    ];
});

// Completed Recommendations
    // application_id
$factory->defineAs(Recommendation::class, 'complete', function (Generator $faker) {
    return [
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName,
        'relationship' => $faker->randomElement(['Teacher', 'Coach', 'Mentor', 'Band Director', 'Club Sponsor', 'Parent']),
        'phone' => $faker->randomNumber(9) . $faker->randomNumber(1),
        'email' => $faker->safeEmail,
        'rank_character' => $faker->randomElement(Recommendation::getRankValues()),
        'rank_additional' => $faker->randomElement(Recommendation::getRankValues()),
        'essay1' => $faker->paragraph(5),
    ];
});
