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

    $user6 = new User;
    $user6->first_name = 'Christina';
    $user6->last_name = 'Soto';
    $user6->save();

    Winner::create([
      'user_id' => $user6->id,
      'description' => 'After playing club volleyball and loving it, Christina Soto helped convince her school to start a volleyball program. She was the captain for three years and led the team to their first winning season last year. Despite facing financial burdens with her family, Christina spent her weekends volunteering, using sports to improve the health and independence of children with disabilities. She gave these children the opportunity to stretch their potential through sports, something they never dreamed of achieving. This experience inspired Christina to pursue psychology and sports medicine in college. She is now a freshman at Baylor University.',
      'photo' => '/dist/images/2013-2014-winners/christina-soto.jpg',
      'college' => 'Baylor University',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user6->id,
      'city' => 'Miami',
      'state' => 'FL',
      ]);

    Application::create([
      'user_id' => $user6->id,
      'participation' => 'Volleyball, Cycling, Skiing, Swimming, Water Polo',
      'gpa' =>  3.7,
    ]);

    $user7 = new User;
    $user7->first_name = 'Cole';
    $user7->last_name = 'Scanlon';
    $user7->save();

    Winner::create([
      'user_id' => $user7->id,
      'description' => 'Cole Scanlon grew up in England, but his mom relocated him and his four siblings to the United States to escape an abusive situation (with his father) at home. Even though he was only 10 when he moved to Miami, Cole knew he had to take on a leadership role in his family; over the years, this translated into a commitment to helping everyone around him too. In high school, Cole spent all of his free time volunteering, running programs for his peers, and refereeing youth soccer. He mentored middle school athletes, coordinated a book drive to start a library at the Dunnmore School in Harbour Island, collected and distributed letters to US troops in the Middle East, organized a back-to-school drive for students in Jamaica, started a booster club for his school sports teams, and founded his not-for-profit “Stride 4 Senegal” to fundraise for athletes and students abroad. It’s clear that he has dedicated his life to giving back. He is a freshman at Harvard College.',
      'photo' => '/dist/images/2013-2014-winners/cole-scanlon.jpg',
      'college' => 'Harvard College',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user7->id,
      'city' => 'Coral Gables',
      'state' => 'FL',
      ]);

    Application::create([
      'user_id' => $user7->id,
      'participation' => 'Football, Soccer, Weightlifting',
      'gpa' =>  3.9,
    ]);

    $user8 = new User;
    $user8->first_name = 'Diwas';
    $user8->last_name = 'Adhikari';
    $user8->save();

    Winner::create([
      'user_id' => $user8->id,
      'description' => 'Diwas Adhikari grew up in a refugee camp in Nepal with little access to water, shelter, or education. Growing up, Diwas used to make soccer balls out of what little resources he could find and create what he needed to play the sport he loved. He served as the captain of his community soccer team and in his free time taught ESL to elder refugees in his neighborhood. Diwas is a freshman at Texas A&M University and studies engineering. He is the first person in his family to go to college and he hopes to use his degree to return to his homeland in Nepal and build the infrastructure that will drive his community’s development.',
      'photo' => '/dist/images/2013-2014-winners/diwas-adhikari.jpg',
      'college' => 'Texas A&M University, College Station',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user8->id,
      'city' => 'Dallas',
      'state' => 'TX',
      ]);

    Application::create([
      'user_id' => $user8->id,
      'participation' => 'Soccer, Swimming and Diving, Tennis',
      'gpa' =>  3.7,
    ]);

    $user9 = new User;
    $user9->first_name = 'Evan';
    $user9->last_name = 'Mercer';
    $user9->save();

    Winner::create([
      'user_id' => $user9->id,
      'description' => 'Evan Mercer was born deaf. His parents were told by specialists that Evan would never learn to read beyond a 4th grade level, nor would he learn to speak. He proved them wrong. Evan was ranked at the top of his senior class and used his experience on the cross country and track teams to help others believe in themselves and their abilities. Evan made it his personal mission to empower people to rise above their disabilities. He founded a mentoring group for 4th and 5th grade students with hearing disabilities working on confidence-building exercises so they can feel comfortable talking to people. As a freshman at Vanderbilt University, Evan is showing people that “you can do a lot, regardless of your different abilities.”',
      'photo' => '/dist/images/2013-2014-winners/evan-mercer.jpg',
      'college' => 'Vanderbilt University',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user9->id,
      'city' => 'Marietta',
      'state' => 'GA',
      ]);

    Application::create([
      'user_id' => $user9->id,
      'participation' => 'Cross Country, Track and Field',
      'gpa' =>  4.0,
    ]);

    $user10 = new User;
    $user10->first_name = 'Hannah';
    $user10->last_name = 'Moran';
    $user10->save();

    Winner::create([
      'user_id' => $user10->id,
      'description' => 'A natural born leader, Hannah Moran was the captain of her gymnastics team and the founder of her school chapter of Big Brothers Big Sisters. Through her initiative, Hannah recruited over 20 classmates to join the mentoring program for low-income students. Growing up, Hannah’s strength was tested when her father was diagnosed with brain cancer. She watched as he underwent treatment after treatment, but she also had the fortune to witness her father recover. This experience inspired Hannah to start a pre-med club at her high school and sparked dreams of becoming a doctor. Hannah is pursuing her passion for medicine as a freshman at Washington University in St. Louis.',
      'photo' => '/dist/images/2013-2014-winners/hannah-moran.jpg',
      'college' => 'Washington University in St. Louis',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user10->id,
      'city' => 'Lawrence',
      'state' => 'KS',
      ]);

    Application::create([
      'user_id' => $user10->id,
      'participation' => 'Gymnastics, Track and Field',
      'gpa' =>  4.0,
    ]);

    $user11 = new User;
    $user11->first_name = 'Joshua';
    $user11->last_name = 'Davis';
    $user11->save();

    Winner::create([
      'user_id' => $user11->id,
      'description' => 'Joshua Davis excels in the classroom and on the field. Despite being homeless for most of his childhood, Joshua was able to accomplish an incredible amount, maintaining a GPA above 4.0 during his high school career. Instead of letting his situation get him down, Joshua was inspired by these hardships and now dreams of one day opening a shelter for young people. He wants to support and encourage young people to focus on education and rise above their circumstances, as he has done. Joshua works hard in all areas of his life, and this is reflected through his accomplishment of joining the starting lineup on his school’s varsity football squad during his senior year of high school. He is now a freshman at Dartmouth College.',
      'photo' => '/dist/images/2013-2014-winners/joshua-davis.jpg',
      'college' => 'Dartmouth College',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user11->id,
      'city' => 'Los Angeles',
      'state' => 'CA',
      ]);

    Application::create([
      'user_id' => $user11->id,
      'participation' => 'Football, Track and Field',
      'gpa' =>  4.0,
    ]);

    $user12 = new User;
    $user12->first_name = 'Karoline';
    $user12->last_name = 'Vanvoorhis';
    $user12->save();

    Winner::create([
      'user_id' => $user12->id,
      'description' => 'Karoline VanVoorhis is an exceptional student and soccer player. When Karoline tore her ACL, it was devastating to more than just her team; her family was also going through tough financial times. Instead of giving up on the sport she loved, Karoline went to work and earned enough money to pay for physical therapy. After some time, she gained back enough strength to join her fellow players on the varsity soccer team her senior year. Karoline is a freshman at Texas Christian University and hopes to use her degree to become either a nurse or a doctor.',
      'photo' => '/dist/images/2013-2014-winners/karoline-vanvoorhis.jpg',
      'college' => 'Texas Christian University',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user12->id,
      'city' => 'Dallas',
      'state' => 'TX',
      ]);

    Application::create([
      'user_id' => $user12->id,
      'participation' => 'Soccer',
      'gpa' => 3.9,
    ]);

    $user13 = new User;
    $user13->first_name = 'Kathleen';
    $user13->last_name = 'Kanaley';
    $user13->save();

    Winner::create([
      'user_id' => $user13->id,
      'description' => 'Kathleen Kanaley puts her everything into school and running. After a brief hiatus due to health concerns, Kathleen was able to regain her strength and was voted team captain for the 2013 cross country season. But her ambition doesn’t end there. Two summers ago, Kathleen volunteered for two months in the Dominican Republic where she worked with local not-for-profit organizations to spread awareness about children’s rights, gender equality, and child abuse. She is a freshman at Fordham University pursuing a degree in International Relations.',
      'photo' => '/dist/images/2013-2014-winners/kathleen-kanaley.jpg',
      'college' => 'Fordham University',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user13->id,
      'city' => 'San Francisco',
      'state' => 'CA',
      ]);

    Application::create([
      'user_id' => $user13->id,
      'participation' => 'Cross Country, Track and Field',
      'gpa' => 4.0,
    ]);

    $user14 = new User;
    $user14->first_name = 'Kimberlyann';
    $user14->last_name = 'Simpson';
    $user14->save();

    Winner::create([
      'user_id' => $user14->id,
      'description' => 'Kimberlyann Simpson dealt with a lot of hardship in her life, mostly involving the absence of any parental figures to support her. Kimberlyann found that it’s important to be her own positive influence to do better, and throughout high school, she relied on her own personal drive to push her to be successful in school and on the field. Despite these hardships, Kimberlyann volunteered as much as she could - at a food bank through her church, at blood drives in her school, and through sports-oriented activities for kids in her community. Kimberlyann believed that sportsmanship and teamwork were integral to her being the best athlete she can be in high school. She is now a freshman at Linfield College.',
      'photo' => '/dist/images/2013-2014-winners/kimberlyann-simpson.jpg',
      'college' => 'Linfield College',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user14->id,
      'city' => 'Eagle Point',
      'state' => 'OR',
      ]);

    Application::create([
      'user_id' => $user14->id,
      'participation' => 'Basketball, Cross Country, Soccer, Track and Field',
      'gpa' => 4.0,
    ]);

    $user15 = new User;
    $user15->first_name = 'Lillie';
    $user15->last_name = 'Meakim';
    $user15->save();

    Winner::create([
      'user_id' => $user15->id,
      'description' => 'Throughout high school, Lillie Meakim was the captain of her school’s track and field team, a team player on her volleyball team, Vice President of the Key Club, and an all-around excellent academic. It’s hard to imagine she had the time for all of it, but Lillie was able to pull it off because of her unwavering commitment to her academics, athletics and community. As an emancipated minor, Lillie has overcome the many challenges of supporting herself while pursuing her passions and excelling in all of them. She is a freshman at St. Olaf University.',
      'photo' => '/dist/images/2013-2014-winners/lillie-meakim.jpg',
      'college' => 'St. Olaf University',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user15->id,
      'city' => 'San Diego',
      'state' => 'CA',
      ]);

    Application::create([
      'user_id' => $user15->id,
      'participation' => 'Track and Field, Volleyball',
      'gpa' => 3.9,
    ]);

    $user16 = new User;
    $user16->first_name = 'Maria';
    $user16->last_name = 'Brouard';
    $user16->save();

    Winner::create([
      'user_id' => $user16->id,
      'description' => 'In high school, Maria Brouard was a three-sport athlete and a five-star student. The confidence she gained through sports – track and field, soccer, and volleyball – inspired Maria to start a tutoring club with a friend. Together, they offered tutoring on any subject three days a week and certified other students to become peer-tutors as well. Maria was ranked #1 in her class and attends Harvard University where she studies biomedical engineering.',
      'photo' => '/dist/images/2013-2014-winners/maria-brouard.jpg',
      'college' => 'Harvard University',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user16->id,
      'city' => 'Dover',
      'state' => 'NJ',
      ]);

    Application::create([
      'user_id' => $user16->id,
      'participation' => 'Track and Field, Soccer, Volleyball',
      'gpa' => 4.0,
    ]);

    $user17 = new User;
    $user17->first_name = 'Michael';
    $user17->last_name = 'Gonzalez';
    $user17->save();

    Winner::create([
      'user_id' => $user17->id,
      'description' => 'Michael Gonzalez grew up in a low-income neighborhood, surrounded by peers and adults who put their lives on a path of destruction. In the midst of this challenging environment, Michael found basketball and as he says, “on the court, I found ambition and dreams, and, once I began dreaming, I dreamed big.” With the confidence and focus he learned from basketball, Michael rose to the top of his class. Michael was a leader among his peers and volunteered for many community-based organizations. He is pursuing a degree in biomedical engineering at University of Texas at Austin.',
      'photo' => '/dist/images/2013-2014-winners/michael-gonzalez.jpg',
      'college' => 'University of Texas at Austin',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user17->id,
      'city' => 'Houston',
      'state' => 'TX',
      ]);

    Application::create([
      'user_id' => $user17->id,
      'participation' => 'Basketball, Cross Country, Football, Track and Field',
      'gpa' => 3.8,
    ]);

    $user18 = new User;
    $user18->first_name = 'Nadaysia';
    $user18->last_name = 'Brooks';
    $user18->save();

    Winner::create([
      'user_id' => $user18->id,
      'description' => 'Throughout high school, Nadaysia Brooks was an exceptional student-athlete. Growing up in an unstable environment at home, Nadaysia used her experiences to become a compassionate leader and volunteer in her community. She was the captain of her basketball and volleyball teams, President of the Beta Club, and a volunteer with several school and community-based organizations. Nadaysia graduated high school with an impressive 3.9 GPA and attends Howard University where she studies accounting.',
      'photo' => '/dist/images/2013-2014-winners/nadaysia-brooks.jpg',
      'college' => 'Howard University',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user18->id,
      'city' => 'Stone Mountain',
      'state' => 'GA',
      ]);

    Application::create([
      'user_id' => $user18->id,
      'participation' => 'Basketball, Volleyball',
      'gpa' => 3.9,
    ]);

    $user19 = new User;
    $user19->first_name = 'Orestes';
    $user19->last_name = 'Marquetti';
    $user19->save();

    Winner::create([
      'user_id' => $user19->id,
      'description' => 'Orestes Marquetti grew up without a country to call his home. He was born into a family in exile – his family was imprisoned for speaking up for freedom in Cuba after an attempted escape. For the first eight years of his life, Orestes’ family barely got by, but they worked hard enough and saved enough money to move to America. Orestes was named the captain of his high school baseball team, served as a leader in Key Club, and ranked at the top of his class. He attends University of Notre Dame where he plans to study engineering like his father.',
      'photo' => '/dist/images/2013-2014-winners/orestes-marquetti.jpg',
      'college' => 'University of Notre Dame',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user19->id,
      'city' => 'North Las Vegas',
      'state' => 'NV',
      ]);

    Application::create([
      'user_id' => $user19->id,
      'participation' => 'Baseball',
      'gpa' => 3.9,
    ]);

    $user20 = new User;
    $user20->first_name = 'Ralph';
    $user20->last_name = 'Etienne';
    $user20->save();

    Winner::create([
      'user_id' => $user20->id,
      'description' => 'Ralph Etienne is an avid tennis player who had to overcome significant odds in order to play the game he loves. Ralph was born with Sickle Cell Anemia, a blood disorder that causes crises of pain that make it difficult to walk, talk, or even breathe. Despite these setbacks, Ralph earned the honor of being co-captain of his high school’s varsity tennis team because of his ability to inspire his teammates. Throughout high school, Ralph was very active outside of school and sports, tutoring students and even starting a chemistry club, of which he was the Co-President. In addition, he was the President of his Key Club, a volunteer at his local hospital and a student activist, as well as a member of a number of different school-based organizations. Ralph was able to accomplish all of this while ranking number four in his class. He now a freshman at Pennsylvania State University.',
      'photo' => '/dist/images/2013-2014-winners/ralph-etienne.jpg',
      'college' => 'Pennsylvania State University',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user20->id,
      'city' => 'Nanuet',
      'state' => 'NY',
      ]);

    Application::create([
      'user_id' => $user20->id,
      'participation' => 'Tennis',
      'gpa' => 4.0,
    ]);

    $user21 = new User;
    $user21->first_name = 'Travis';
    $user21->last_name = 'Gayle';
    $user21->save();

    Winner::create([
      'user_id' => $user21->id,
      'description' => 'During high school, Travis Gayle was an upstanding leader in his community, his school, and on his sports teams. He grew up in a rough area in New York, but he never let that get him down. Early on, Travis decided he was not going to let his surroundings or stereotypes define what he was capable of accomplishing. Travis was the quintessential all-around high school athlete, participating in rugby, basketball, and track and field (all while maintaining a 4.0 GPA!). In addition, Travis was a member of the NYC Urban Ambassadors program. Travis is pursuing a degree in computer science at University of Notre Dame.',
      'photo' => '/dist/images/2013-2014-winners/travis-gayle.jpg',
      'college' => 'University of Notre Dame',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user21->id,
      'city' => 'Jamaica',
      'state' => 'NY',
      ]);

    Application::create([
      'user_id' => $user21->id,
      'participation' => 'Track and Field, Rugby, Basketball',
      'gpa' => 4.0,
    ]);

    $user22 = new User;
    $user22->first_name = 'Vivian';
    $user22->last_name = 'Nguyen';
    $user22->save();

    Winner::create([
      'user_id' => $user22->id,
      'description' => 'Throughout high school, Vivian Nguyen was a stellar athlete, student, and leader. She was the President of Ridge Athletes for Literacy, a club that brings high school students into elementary schools to promote the value of reading. Under Vivian’s leadership, she expanded the club to include over 100 students from her school and built partnerships with several local elementary classrooms. Vivian’s strength was tested when she lost both her grandmother and her mother to cancer within the same year. At the time, Vivian also learned she might be a carrier of BRCA 2, a genetically inherited gene that increases her risk of breast cancer. Despite the loss and her daunting possibility of cancer, Vivian found the courage to fight for a bright future. Vivian attends Howard Page University and hopes to pursue a career in oncology, so she can help families like hers.',
      'photo' => '/dist/images/2013-2014-winners/vivian-nguyen.jpg',
      'college' => 'Howard Page University',
      'scholarship_id' => 0,
    ]);


    Profile::create([
      'user_id' => $user22->id,
      'city' => 'Fort Worth',
      'state' => 'TX',
      ]);

    Application::create([
      'user_id' => $user22->id,
      'participation' => 'Soccer',
      'gpa' => 4.0,
    ]);
  }
}
