{{-- About Page Template --}}

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
        {{ $block->block_description_html }}
        {{ $block->block_body_html }}
      </section>
    @endforeach

  </article>
@stop
