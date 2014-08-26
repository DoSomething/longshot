@extends('layouts.master')

@section('main_content')
  <section class="segment">
    <h1 class="heading -alpha">Application Status</h1>

    <h2>{{ Auth::check() ? 'Welcome, ' . Auth::user()->first_name : 'Welcome to the Scholarship App!' }}</h2>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut non ratione laborum, nemo voluptates magni ipsum velit ullam hic, fuga!</p>

    <p>{{ link_to_route('profile.create', 'Start Application', null, ['class' => 'btn -default']) }}</p>
  </section>
@stop
