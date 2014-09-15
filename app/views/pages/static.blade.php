@extends('layouts.master')

@section('main_content')
  <div class="banner -hero">
    <div class="wrapper">
      <h2 class="__tagline">{{ $page->title }}</h2>
    </div>
  </div>

  <section class="segment">
    {{ $page->description }}
  </section>
@stop
