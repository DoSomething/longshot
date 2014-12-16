<?php

class WaterGateSeeder extends Seeder {

  /**
   * Seed the Users table.
   *
   * @return void
   */
  public function run()
  {
    // Allow for timestamps and keys to be saved.
    Eloquent::unguard();
    $csv = 'watergate.csv';
    if (FALSE !== ($fh = fopen($csv, 'r'))) {
      // Get the first row outta there.
      $cols = fgetcsv($fh);
      $count = 1;
      while ($row = fgetcsv($fh)) {
        // if ($count > 4) {
        //   die;
        // }
        var_dump($row);
        print "\n";
        print "\n";
        print "\n";
        $user = User::create([
          'email'      => $row[1],
          'password'   => $row[2],
          'first_name' => $row[3],
          'last_name'  => $row[4],
          'created_at' => $row[6],
          'updated_at' => $row[7]
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
            'updated_at'      => $row[20]
          ]);
          $user->profile()->save($profile);

          if ($row[21] != '0') {
            $races = explode(',', $row[21]);
            foreach($races as $race) {
              $new_race = new Race;
              $new_race->race = $race;
              $new_race->profile()->associate($profile);
              $new_race->save();
            }
          }
        }
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
            'submitted'         => $row[33],
            'completed'         => $row[34],
            'created_at'        => $row[35],
            'updated_at'        => $row[36],
            ]);
          $user->application()->save($application);

        }
        echo "done with " .  $row[1]  . "\n";
        $count ++;

      }
    }
  }

  public function match_recs()
  {

  }

  public function create_recs()
  {
     // Let's use another file for recs
    $csv = 'recs.csv';
    if (FALSE !== ($fh = fopen($csv, 'r'))) {
      // Get the first row outta there.
      $cols = fgetcsv($fh);
      while ($rec = fgetcsv($fh)) {
        $app_ids[] = $rec[0];
        $recommendation = Recommendation::create([
          'first_name'        => $rec[1],
          'last_name'         => $rec[2],
          'email'             => $rec[3],
          'phone'             => $rec[4],
          'relationship'      => $rec[5],
          'rank_character'    => ($rec[6] != '0') ? $rec[6] : NULL,
          'rank_additional'   => ($rec[7] != '0') ? $rec[7] : NULL,
          'essay1'            => ($rec[8] != '0') ? $rec[8] : NULL,
          'optional_question' => ($rec[9] != '0') ? $rec[9] : NULL,
        ]);
        $all_recs[$rec[0]] = $recommendation;

      }
    }

  }
}