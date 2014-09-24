{{-- Static Page Template --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">{{ $page->title }}</h1>

    <div class="segment">
      {{ $page->description_html }}
    </div>

    {{-- Output Blocks --}}
    @foreach($page->blocks as $block)
      @include('pages.partials._block_' . outputBlock($block))
    @endforeach

  </article>
@stop
