@extends('layouts.master')

@section('main_content')
  <article class="page">

    <header class="banner -hero">
      <div class="wrapper">
        <h1 class="__title heading -alpha">{{ $page->title }}</h1>
        <h2 class="__tagline heading -gamma">{{ $page->description }}</h2>
      </div>
    </header>

    @foreach($page->blocks as $block)
      <section class="segment">
        <h1 class="heading -alpha">{{ $block->block_title }}</h1>
        {{ $block->block_body_html }}
      </section>
    @endforeach

    <section class="segment segment--nominate -compact">
      <div class="wrapper">
        <h1 class="__title heading -alpha -alt">Nominate A Star</h1>

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
