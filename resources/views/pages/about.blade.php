{{-- About Page Template --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">

    <header class="banner -hero">
      <div class="wrapper">
        <h1 class="__title heading -alpha">{{ $page->title }}</h1>
        <h2 class="__tagline heading -beta">{{ $page->description }}</h2>
      </div>
      <div class="__image" style="background-image: url('{{ asset_url($page->hero_image, '/dist/images/hero-image-placeholder-2.jpg') }}');"></div>
    </header>

    {{-- Output Blocks --}}
    @foreach($page->blocks as $block)
      @include('pages.partials._block_' . outputBlock($block))
    @endforeach

  </article>
@stop
