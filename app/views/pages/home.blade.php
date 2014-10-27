@extends('layouts.master')

@section('main_content')
  <article class="page">

    <header class="banner -hero">
      <div class="wrapper">
        <h1 class="__title heading -alpha">{{ $page->title }}</h1>
        <h2 class="__tagline heading -beta">{{ $page->description }}</h2>
      </div>
      <div class="__image" style="background-image: url('{{ $page->hero_image or '/dist/images/hero-image-placeholder-1.jpg' }}');"></div>
    </header>

    {{-- Output Blocks --}}
    @foreach($page->blocks as $block)
      @include('pages.partials._block_' . outputBlock($block))
    @endforeach

    <section id="nominate" class="segment segment--nominate">
      <div class="wrapper">
        <h1 class="__title heading -alpha -alt">Nominate A Star</h1>

        @if (!empty($vars->nominate_text))
          <p class="__message">{{ $vars->nominate_text }}</p>
        @endif

        {{ Form::open(['route' => 'nomination.create']) }}

          <div class="fragment -alpha">
            <h2 class="heading -delta">Your Info</h2>

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

          <div class="fragment -beta">
            <h2 class="heading -delta">Their Info</h2>

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

          <div class="field-group -action">
            {{ Form::submit('Nominate', ['class' => 'button -default']) }}
          </div>

        {{ Form::close() }}
      </div>
      <div class="__image" style="background-image: url('{{ $vars->nominate_image or '/dist/images/nominate-image-placeholder.jpg' }}');"></div>
    </section>

    <section class="segment segment--gallery" data-modal="">
      <div class="wrapper">
        <h1 class="__title heading -alpha">2013-2014 Class</h1>

        @include('pages.partials._winners-gallery')

      </div>
    </section>

  </article>
@stop
