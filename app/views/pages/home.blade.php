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

    {{-- Only include nomination form if still open. --}}
    @if(!Scholarship::isClosed('nomination') && Scholarship::isOpen())
      @include('pages.partials._nomination-form')
    @endif

    @include('pages.partials._winners-gallery')

  </article>
@stop
