{{-- FAQ Page Template --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">{{ $page->title }}</h1>

    <div class="segment">
      <div class="wrapper">
        {{ $page->description_html }}
      </div>
    </div>

    @foreach($page->blocks as $block)
      <section class="segment">
        <div class="wrapper">
          <h1 class="heading -gamma">{{ $block->block_title }}</h1>
          {{ $block->block_body_html }}
        </div>
      </section>
    @endforeach

  </article>
@stop
