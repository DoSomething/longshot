# Longshot App

## Prerequisites
1.  Composer
2.  Node
3.  Homestead or [DS Homestead](https://github.com/DoSomething/ds-homestead) for DoSomething developers
4.  Sequel Pro

## Local Development Setup
1. Clone the repo
2. Create a `.env` file from `.env.example` and make sure your `.env.local.php` has the correct keys for your dev environment. Reach out to the tech team for the correct keys to use in your dev environments `.env.local.php` file.
3. Edit your `Homestead.yml` file to include this new info. Making sure the `folders` and `sites` configuration is correct for your local set up. You might need to run `vagrant provision` after you make this update.
4. Add your app url (longshot.dev) to your `etc/hosts` file i.e. `127.0.0.1 longshot.dev`
5. Manually create a `scholarship_app` database in Sequel Pro.
    - Open a `new connection` window and click on the `standard` connection tab
    - Name the connection 
    - Enter host info: `127.0.0.1`
    - Username: `homestead` 
    - Enter password from `.env.local.php` file
    - Port: `33060`
    - Hit `connect`
    - In the `choose database` dropdown select `add database`
    - Name the database `scholarship_app` with UTF-8 encoding.
    - In order to run tests, make another database called `longshot_testing`
6. One you finish the rest of the setup below, you can see the whole pretty site at `longshot.dev:8000`

### Composer

Before doing anything else, you need to install all the project's dependencies with `composer`. 

Within the directory for the project in the Vagrant VM ([instructions here](https://github.com/DoSomething/ds-homestead#ssh-into-virtual-machine)), run:

    $ composer install

### Back-end

To run the migrations to setup your database and then immediately seed it, run (also from the project directory in vagrant):

    $ php artisan migrate && php artisan db:seed

### Front-end

The following commands need to be run from within the root directory for the project on the virtual machine (get comfy in there).

To install the required NPM modules, run:

    $ npm install

To install the required Bower front-end packages, run:

    $ bower install

To build the Front-end assets which will be added to a **/public/dist/** directory, run:

    $ gulp

Whenever you need to edit anything in **/resources/assets/** you will need to `gulp` again. To have that happen automatically, run `gulp watch` to keep watching for changes :eyes:

### Testing

In order to run tests, you need to have created the `longshot_testing` database. Then, go to the project directory in vagrant and run `vendor/bin/phpunit`. Tests run automatically on PRs as well.

Pro-tip: If you are debugging tests and crash in the middle, the tests will not get to the step where they roll back all the migrations on the testing database. Not rolling back means that if you try to run the tests again, it will crash because there are unexpected tables in there. So, if you crash during a test, you will need to manually drop those tables before running again :runner:

***



## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/downloads.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
