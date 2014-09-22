{{-- FAQ Page Template --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">{{ $page->title }}</h1>

    <div class="segment">
      {{ $page->description_html }}
    </div>

    @foreach($page->blocks as $block)
      <section class="segment">
        <h1 class="heading -gamma">{{ $block->block_title }}</h1>
        {{ $block->block_description_html }}
        {{ $block->block_body_html }}
      </section>
    @endforeach

  </article>
@stop
