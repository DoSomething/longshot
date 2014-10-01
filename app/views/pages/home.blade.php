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

    <section class="segment segment--nominate">
      <div class="wrapper">
        <h1 class="__title heading -alpha -alt">Nominate A Star</h1>

        @if(! empty($vars->nominate_text))
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

    <section class="segment segment--gallery">
      <div class="wrapper">
        <h1 class="__title heading -alpha">2013-2014 Class</h1>

        <ul class="gallery">
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/aaliyah-danielson.jpg" alt="Image of scholarship winner Aaliyah Danielson">
                <figcaption>Aaliyah</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/bryan-caraballo.jpg" alt="Image of scholarship winner Bryan Caraballo">
                <figcaption>Bryan</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/carson-arthur.jpg" alt="Image of scholarship winner Carson Arthur">
                <figcaption>Carson</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/christina-soto.jpg" alt="Image of scholarship winner Christina Soto">
                <figcaption>Christina</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/cole-scanlon.jpg" alt="Image of scholarship winner Cole Scanlon">
                <figcaption>Cole</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/diwas-adhikari.jpg" alt="Image of scholarship winner Diwas Adhikari">
                <figcaption>Diwas</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/evan-mercer.jpg" alt="Image of scholarship winner Evan Mercer">
                <figcaption>Evan</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/hannah-moran.jpg" alt="Image of scholarship winner Hannah Moran">
                <figcaption>Hannah</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/joshua-davis.jpg" alt="Image of scholarship winner Joshua Davis">
                <figcaption>Joshua</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/karoline-vanvoorhis.jpg" alt="Image of scholarship winner Karoline Vanvoorhis">
                <figcaption>Karoline</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/kathleen-kanaley.jpg" alt="Image of scholarship winner Kathleen Kanaley">
                <figcaption>Kathleen</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/kimberlyann-simpson.jpg" alt="Image of scholarship winner Kimberlyann Simpson">
                <figcaption>Kimberlyann</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/lillie-meakim.jpg" alt="Image of scholarship winner Lillie Meakim">
                <figcaption>Lillie</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/maria-brouard.jpg" alt="Image of scholarship winner Maria Brouard">
                <figcaption>Maria</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/michael-gonzalez.jpg" alt="Image of scholarship winner Michael Gonzalez">
                <figcaption>Michael</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/nadaysia-brooks.jpg" alt="Image of scholarship winner Nadaysia Brooks">
                <figcaption>Nadaysia</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/orestes-marquetti.jpg" alt="Image of scholarship winner Orestes Marquetti">
                <figcaption>Orestes</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/ralph-etienne.jpg" alt="Image of scholarship winner Ralph Etienne">
                <figcaption>Ralph</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/travis-gayle.jpg" alt="Image of scholarship winner Travis Gayle">
                <figcaption>Travis</figcaption>
              </figure>
            </article>
          </li>
          <li>
            <article class="tile">
              <figure>
                <img src="/dist/images/2013-2014-winners/vivian-nguyen.jpg" alt="Image of scholarship winner Vivian Nguyen">
                <figcaption>Vivian</figcaption>
              </figure>
            </article>
          </li>
        </ul>
      </div>
    </section>

  </article>
@stop
