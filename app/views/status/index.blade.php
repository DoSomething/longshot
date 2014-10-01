{{-- Status --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Application Status</h1>

    <div class="segment">
      <div class="wrapper">
        <h2 class="heading -gamma">Status: <em> {{ $status }} </em></h2>
        @if(! empty($help_text))
          <p>{{ $help_text }}</p>
        @endif

        <p>Thank you for submitting your application. Come back here to check on your application status. Your application will be complete once we receive the required recommendation(s).</p>
      </div>
    </div>

    <section class="segment segment--checklist">
      <div class="wrapper">
        <h1 class="heading -gamma">What's up</h1>

        <ul class="media-list media-list--status">
          <li class="{{ isset($prof_complete) ? 'complete' : '-incomplete' }}">
            <span class="icon icon-status" data-icon="&#x2713"></span>Basic Information
            {{-- isset($profile) ? iconLinkToRoute('profile.edit', 'Edit', Auth::user()->id, ['class' => 'icon icon-edit']) : iconLinkToRoute('profile.create', 'Start', null, ['class' => 'icon icon-edit']) --}}
            {{ isset($profile) ? '<a class="__link" href="' . URL::route('profile.edit', Auth::user()->id) . '">Edit<span class="icon icon-edit"></span></a>' : '<a class="" href="' . URL::route('profile.create', null) . '">Start<span class="icon icon-start"></span></a>' }}
          </li>
          <li class="{{ isset($app_complete) ? 'complete' : '-incomplete' }}">
            <span class="icon icon-status" data-icon="&#x2713"></span>Application
            @if (isset($application) && !($application->complete))
              {{ '<a class="__link" href="' . URL::route('application.edit', Auth::user()->id) . '">Edit<span class="icon icon-edit"></span></a>' }}

            @elseif (is_null($application) && !is_null($profile))
              {{ '<a class="__link" href="' . URL::route('application.create', Auth::user()->id) . '">Start<span class="icon icon-start"></span></a>' }}
            @endif
          </li>
        </ul>


        @if (isset($submit))
          {{ $submit }}
        @endif


        @if (!empty($recommendations))

                @foreach($recommendations as $rec)

                    {{ $rec['first_name'] . ' ' . $rec['last_name']}}
                    {{ $rec['email'] }}
                     {{$rec['complete']}}
                    @if ($rec['complete'] != 'All set!')
                       {{link_to_route('resend', 'Resend Request', array('id' => $rec['id']))}}
                    @endif

                @endforeach



            @if (isset($add_rec_link))
              {{ $add_rec_link }}
            @endif


        @elseif (!is_null($application))
          {{link_to_route('recommendation.create', 'Get Recommendations');}}
        @endif



      </div>
    </section>

    <section class="segment segment--timeline">
      <div class="wrapper">

        <h2 class="heading -gamma">Key Dates</h1>

        {{ $timeline }}

      </h2>
    </section>


    <footer>
      <div class="wrapper">
        <p>Need help? <a href="mailto:{{Config::get('mail.from.address')}}">Contact Us</a></p>
      </div>
    </footer>

  </article>
@stop
