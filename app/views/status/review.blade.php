{{-- Status --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Review & Submit</h1>

    <h3> Basic Info </h3>
    @foreach ($profile as $key => $field)
      @if (!empty($field))
       <h4> {{ $key }} : </h4>
       {{ $field }}
      @endif
    @endforeach

    <h3> Application </h3>
    @foreach ($application as $key => $field)
     {{-- did the have a value in the field --}}
      @if (!empty($field))
      {{-- does the field have a better title in the scholarship? --}}
      @if (isset($scholarship[$key]))
       <h4> {{ $scholarship[$key] }} : </h4>
       @else
        <h4> {{ $key }} </h4>
       @endif

       {{ $field }}
      @endif
    @endforeach



    <div class="contact">
      <p>Need help? <a href="mailto:gthomas@tmiagency.org">Contact Us</a></p>
    </div>

  </article>
@stop
