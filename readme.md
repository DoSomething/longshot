# Scholarship Application App

## Prerequisites
1.  Composer
2.  Node
3.  Homestead

## Local Development Setup
1. Clone the repo
2. Create a .env.local.php file from default.env.local.php
3. Edit your `Homestead.yml` file to include this new info
4. Add your app url (scholarship.dev) to your `etc/hosts` file
5. Run `php artisan migrate` to create the database
6. Visit scholarship.dev:8000

### Back-end

To begin the migrations and setup your database, run:

    $ php artisan migrate

After the migrations run and set the database up, seed the database by running:

    $ php artisan db:seed


### Front-end
Development uses a typical **Homestead** setup for a virtual machine. Once the machine is up and running run `vagrant ssh` and change directories into the laravel project directory.

From the laravel project directory install the NPM modules, by running:

    $ npm install

To install the Bower front-end packages, run:

    $ bower install

To build the Front-end assets which will be added to a **/public/dist/** directory, run:

    $ gulp build



***


## Laravel PHP Framework

[![Build Status](https://travis-ci.org/laravel/framework.svg)](https://travis-ci.org/laravel/framework)
[![Total Downloads](https://poser.pugx.org/laravel/framework/downloads.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://poser.pugx.org/laravel/framework/v/stable.svg)](https://packagist.org/packages/laravel/framework)
[![Latest Unstable Version](https://poser.pugx.org/laravel/framework/v/unstable.svg)](https://packagist.org/packages/laravel/framework)
[![License](https://poser.pugx.org/laravel/framework/license.svg)](https://packagist.org/packages/laravel/framework)

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, and caching.

Laravel aims to make the development process a pleasing one for the developer without sacrificing application functionality. Happy developers make the best code. To this end, we've attempted to combine the very best of what we have seen in other web frameworks, including frameworks implemented in other languages, such as Ruby on Rails, ASP.NET MVC, and Sinatra.

Laravel is accessible, yet powerful, providing powerful tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the entire framework can be found on the [Laravel website](http://laravel.com/docs).

### Contributing To Laravel

**All issues and pull requests should be filed on the [laravel/framework](http://github.com/laravel/framework) repository.**

### License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
