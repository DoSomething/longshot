<?php

class PreviousWinnersTableSeeder extends Seeder {
  /**
   * Seed the winner/users table.
   *
   * @return void
   */
  public function run()
  {
    // Needed to fill protected fields in tables.
    Eloquent::unguard();
    $user = new User;
    $user->first_name =  'Aaliyah';
    $user->last_name  = 'Danielson';

    $user->save();

    Winner::create([
      'user_id' => $user->id,
      'description' => 'Aaliyah Danielson sets an example of bravery in the face of challenge. She’s brave on the field, in the classroom, and she was brave after a devastating car accident broke her vertebrate and almost took her ability to walk. In the hospital, Aaliyah decided she was going to fight her hardest to use her legs and get back on the field. And she succeeded. She became a star on her soccer team and spent her free time in high school volunteering in a kindergarten classroom and the Humane Society. Aaliyah is studying nursing as a freshman at the University of North Dakota.',
      'photo' => '/dist/images/2013-2014-winners/aaliyah-danielson.jpg',
      'college' => 'University of North Dakota',
      'scholarship_id' => 0,
      ]);

    Profile::create([
      'user_id' => $user->id,
      'city' => 'Woodbury',
      'state' => 'MN',
      ]);

    Application::create([
      'user_id' => $user->id,
      'gpa' => 3.6,
      'participation' => 'Basketball and Soccer',
    ]);

    $user1 = new User;
    $user1->first_name = 'Bryan';
    $user1->last_name = 'Caraballo';
    $user1->save();

    Winner::create([
      'user_id' => $user1->id,
      'description' => 'Bryan Carabello was the captain of his soccer and wrestling teams at his school in the South Bronx. Growing up in the Bronx, Bryan was no stranger to gangs and violence. He rose above these temptations; instead of letting his environment get him down, Bryan decided to give back to his community. He mentored young students from low-income families and volunteered in a nursing home. It’s this love of giving back that also drew Bryan to travel to Malawi to assist in building a much-needed school. Bryan is a freshman at Middlebury College and will be the first person in his family to earn his college degree!',
      'photo' => '/dist/images/2013-2014-winners/bryan-caraballo.jpg',
      'college' => 'Middlebury College',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user1->id,
      'city' => 'Bronx',
      'state' => 'NY',
      ]);

    Application::create([
      'user_id' => $user1->id,
      'gpa' => 4.0,
      'participation' => 'Baseball, Soccer, Wrestling',
    ]);

    $user2 = new User;
    $user2->first_name = 'Carson';
    $user2->last_name = 'Arthur';
    $user2->save();

    Winner::create([
      'user_id' => $user2->id,
      'description' => 'Carson Arthur learned early on what it means to fight for something. When he was three years old, Carson was diagnosed with Leukemia and was saved by a bone marrow transplant. Last year, Carson decided to celebrate 11 years of being cancer-free by helping his peers sign up for the bone marrow donor registry and fundraising for the cause. He single-handedly added 75 potential donors and raised over $4,500 for “Be the Match” Registry and Duke Children’s Hospital. Despite Carson’s struggle with Leukemia, he was able to excel on his varsity baseball team, and served as an inspiration to his community. Carson was ranked at the top of his class and is pursuing a business degree at the University of North Carolina at Chapel Hill',
      'photo' => '/dist/images/2013-2014-winners/carson-arthur.jpg',
      'college' => 'University of North Carolina, Chapel Hill',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user2->id,
      'city' => 'Roanoke Rapids',
      'state' => 'NC',
      ]);

    Application::create([
      'user_id' => $user2->id,
      'participation' => 'Baseball',
      'gpa' =>  3.9,
    ]);

  }
}
