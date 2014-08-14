@extends('layouts.master')

@section('main_content')
  <h1>{{ Auth::check() ? 'Welcome, ' . Auth::user()->first_name : 'Welcome to the Scholarship App!' }}</h1>

  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas, adipisci!</p>
  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio doloribus, cumque voluptatem, dolor velit eveniet quidem. Dolore incidunt a asperiores vero natus est quibusdam suscipit quos magnam iste dignissimos, modi pariatur consequuntur soluta, architecto commodi!</p>

  @if (Auth::guest())
    <a href="/register">Apply Now</a> or <a href="/login">Continue your application</a>
  @endif
@stop
