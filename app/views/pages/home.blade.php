@extends('layouts.master')

@section('main_content')
  <article class="page">

    <header class="banner -hero">
      <div class="wrapper">
        <h1 class="__title visually-hidden">Welcome</h1>
        <h2 class="__tagline">We're giving away 20 $10,000 Scholarships to people just like you</h2>
      </div>
    </header>

    <section class="segment segment--apply">
      <h1 class="heading -alpha">Apply Today</h1>

      <p>Front-end styles are being updated significantly so some things may be visually broken temporarily!</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam, ad.</p>

      @if (Auth::guest())
        <ul class="media-list">
          <li>{{ link_to_route('registration.create', 'Start Application', null, ['class' => 'button -default']) }}</a></li>
          <li>{{ link_to_route('login', 'Continue your application') }}</a></li>
        </ul>
      @endif
    </section>

    <section class="segment segment--steps">
      <h1 class="heading -alpha">How To Enter</h1>

      <div><span>$10K</span> Scholarship</div>

      <ol>
        <li>
          <h2>Get the details</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, sit.</p>
        </li>
        <li>
          <h2>Start your app</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, sit.</p>
        </li>
        <li>
          <h2>Check out the FAQ</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, sit.</p>
        </li>
      </ol>
    </section>

    <section class="segment segment--nominate">
      <div class="wrapper">
        <h1 class="heading -alpha -alt">Nominate A Star</h1>

        {{ Form::open(['route' => 'nomination.create']) }}

          <div>
            <h2>Your Info</h2>

            {{-- Nominator Name --}}
            <div class="field-group">
              {{ Form::label('rec_name', 'Your Name: ') }}
              {{ Form::text('rec_name') }}
              {{ errorsFor('rec_name', $errors); }}
            </div>

            {{-- Nominator Email --}}
            <div class="field-group">
              {{ Form::label('rec_email', 'Your Email: ') }}
              {{ Form::email('rec_email') }}
              {{ errorsFor('rec_email', $errors); }}
            </div>
          </div>

          <div>
            <h2>Their Info</h2>

            {{-- Nominatee Name --}}
            <div class="field-group">
              {{ Form::label('nom_name', 'Their Name: ') }}
              {{ Form::text('nom_name') }}
              {{ errorsFor('nom_name', $errors); }}
            </div>

            {{-- Nominatee Email --}}
            <div class="field-group">
              {{ Form::label('nom_email', 'Their Email: ') }}
              {{ Form::email('nom_email') }}
              {{ errorsFor('nom_email', $errors); }}
            </div>
          </div>

            {{ Form::submit('Nominate', ['class' => 'button -default']) }}
        {{ Form::close() }}
      </div>
    </section>

  </article>
@stop
