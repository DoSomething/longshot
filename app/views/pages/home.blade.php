@extends('layouts.master')

@section('main_content')
  <div class="banner -hero">
    <h2 class="__tagline">We're giving away 20 $10,000 Scholarships to people just like you</h2>
  </div>

  <section class="segment segment--apply">
    <h1 class="heading -alpha">Apply Today</h1>

    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio doloribus, cumque voluptatem, dolor velit eveniet quidem. Dolore incidunt a asperiores vero natus est quibusdam suscipit quos magnam iste dignissimos, modi pariatur consequuntur soluta, architecto commodi!</p>

    @if (Auth::guest())
      <ul class="media-list">
        <li>{{ link_to_route('registration.create', 'Start Application', null, ['class' => 'btn -default']) }}</a></li>
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

      {{ Form::open() }}

        <div>
          <h2>Your Info</h2>

          {{-- Nominator Name --}}
          <div class="field-group">
            {{ Form::label('nominator_name', 'Your Name: ') }}
            {{ Form::text('nominator_name') }}
            {{ errorsFor('nominator_name', $errors); }}
          </div>

          {{-- Nominator Email --}}
          <div class="field-group">
            {{ Form::label('nominator_email', 'Your Email: ') }}
            {{ Form::text('nominator_email') }}
            {{ errorsFor('nominator_email', $errors); }}
          </div>
        </div>

        <div>
          <h2>Their Info</h2>

          {{-- Nominatee Name --}}
          <div class="field-group">
            {{ Form::label('nominatee_name', 'Their Name: ') }}
            {{ Form::text('nominatee_name') }}
            {{ errorsFor('nominatee_name', $errors); }}
          </div>

          {{-- Nominatee Email --}}
          <div class="field-group">
            {{ Form::label('nominatee_email', 'Their Email: ') }}
            {{ Form::text('nominatee_email') }}
            {{ errorsFor('nominatee_email', $errors); }}
          </div>
        </div>

          {{ Form::submit('Nominate', ['class' => 'btn -default']) }}
      {{ Form::close() }}
    </div>
  </section>
@stop
