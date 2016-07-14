<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Race;
use App\Models\Application;
use App\Models\Recommendation;

class WaterGateSeeder extends Seeder
{
    /**
   * Seed the Users table.
   *
   * @return void
   */
  public function run()
  {
      // Allow for timestamps and keys to be saved.
    Eloquent::unguard();

    // NEW USERS
    // Create all recs so we know which app_ids have recs when we get there.
    $recs = $this->createRecs();
      $rec_app_ids = $recs[0];
      $all_recs = $recs[1];

      $csv = 'created.csv';
      if (false !== ($fh = fopen($csv, 'r'))) {
          // Get the first row outta there.
      $cols = fgetcsv($fh);
          while ($row = fgetcsv($fh)) {
              $user = User::create([
          'email'      => $row[1],
          'password'   => $row[2],
          'first_name' => $row[3],
          'last_name'  => $row[4],
          'created_at' => $row[6],
          'updated_at' => $row[7],
        ]);

        // Has the person started a profile?
        if ($row[8] != '0') {
            $profile = Profile::create([
            'birthdate'       => $row[9],
            'phone'           => $row[10],
            'address_street'  => $row[11],
            'address_premise' => $row[12],
            'city'            => $row[13],
            'state'           => $row[14],
            'zip'             => $row[15],
            'gender'          => $row[16],
            'school'          => $row[17],
            'grade'           => $row[18],
            'created_at'      => $row[19],
            'updated_at'      => $row[20],
          ]);
            $user->profile()->save($profile);

            if ($row[21] != '0') {
                $races = explode(',', $row[21]);
                foreach ($races as $race) {
                    $new_race = new Race();
                    $new_race->race = $race;
                    $new_race->profile()->associate($profile);
                    $new_race->save();
                }
            }
        }
        // Has this person started the app?
        $app_id = $row[22];
              if ($app_id != '0') {
                  $application = Application::create([
            'scholarship_id'    => 1,
            'accomplishments'   => $row[23],
            'activities'        => $row[24],
            'participation'     => $row[25],
            'essay1'            => $row[26],
            'essay2'            => $row[27],
            'hear_about'        => $row[28],
            'link'              => $row[29],
            'test_type'         => $row[30],
            'test_score'        => $row[31],
            'gpa'               => $row[32],
            'submitted'         => ($row[33] != '0') ? $row[33] : null,
            'completed'         => ($row[34] != '0') ? $row[34] : null,
            'created_at'        => $row[35],
            'updated_at'        => $row[36],
            ]);
                  $user->application()->save($application);

          // Associate the app with the recs if they are there.
          // Do the same thing twice, becuase a user may have 2 recs.
          // When broken out into a function the unsets don't stick.
          while (($key = array_search($app_id, $rec_app_ids)) !== false) {
              unset($rec_app_ids[$key]);
              $recommendation = $all_recs[$key];
              $recommendation->application()->associate($application);
              $recommendation->save();
              echo 'associate '.$application->id.' with '.$recommendation->id."\n";
          }
              }
              echo 'done with '.$row[1]."\n";
          }
      }
      fclose($fh);

    // USERS WHO HAVE UPDATED CONTENT
    $csv = 'updated.csv';
      if (false !== ($fh = fopen($csv, 'r'))) {
          // Get the first row outta there.
      $cols = fgetcsv($fh);
          while ($row = fgetcsv($fh)) {
              $profile = Profile::whereId($row[8])->firstOrFail();
              $profile->birthdate = $row[9];
              $profile->phone = $row[10];
              $profile->address_street = $row[11];
              $profile->address_premise = $row[12];
              $profile->city = $row[13];
              $profile->state = $row[14];
              $profile->zip = $row[15];
              $profile->gender = $row[16];
              $profile->school = $row[17];
              $profile->grade = $row[18];
              $profile->created_at = $row[19];
              $profile->updated_at = $row[20];
              $profile->save();
              if ($row[21] != '0') {
                  $races = explode(',', $row[21]);
                  foreach ($races as $race) {
                      $new_race = new Race();
                      $new_race->race = $race;
                      $new_race->profile()->associate($profile);
                      $new_race->save();
                  }
              }

              $application = Application::whereId($row[22])->firstOrFail();
              $application->scholarship_id = 1;
              $application->accomplishments = $row[23];
              $application->activities = $row[24];
              $application->participation = $row[25];
              $application->essay1 = $row[26];
              $application->essay2 = $row[27];
              $application->hear_about = $row[28];
              $application->link = $row[29];
              $application->test_type = $row[30];
              $application->test_score = $row[31];
              $application->gpa = $row[32];
              $application->submitted = ($row[33] != '0') ? $row[33] : null;
              $application->completed = ($row[34] != '0') ? $row[34] : null;
              $application->created_at = $row[35];
              $application->updated_at = $row[36];

              $application->save();

              echo 'updated  '.$row[1]."\n";
          }
      }
      fclose($fh);
  }

    public function createRecs()
    {
        // Let's use another file for recs
    $csv = 'recs.csv';
        if (false !== ($fh = fopen($csv, 'r'))) {
            // Get the first row outta there.
      $cols = fgetcsv($fh);
            while ($rec = fgetcsv($fh)) {
                $app_ids[] = $rec[0];
        // This will create recs with zeroed out app_ids
        // If there are any left, we can manually resolve the data.
        // in testing I had two left over of people who updated their rec
        // but not their app during this time frame.
        $recommendation = Recommendation::create([
          'first_name'        => $rec[1],
          'last_name'         => $rec[2],
          'email'             => $rec[3],
          'phone'             => $rec[4],
          'relationship'      => $rec[5],
          'rank_character'    => ($rec[6] != '0') ? $rec[6] : null,
          'rank_additional'   => ($rec[7] != '0') ? $rec[7] : null,
          'essay1'            => ($rec[8] != '0') ? $rec[8] : null,
          'optional_question' => ($rec[9] != '0') ? $rec[9] : null,
        ]);
                $all_recs[] = $recommendation;
            }
            fclose($fh);

            return [$app_ids, $all_recs];
        }
    }
}
