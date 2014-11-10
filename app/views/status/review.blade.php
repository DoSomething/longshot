{{-- Status --}}

@extends('layouts.master')

@section('main_content')
  <article class="page">
    <h1 class="__title heading -beta text-primary-color">Review &amp; Submit</h1>

    <section class="segment segment--review -compact">
      <div class="wrapper">

        @if (!empty($vars->application_submit_help_text))
          <p>{{ $vars->application_submit_help_text }}</p>
        @endif

        <div class="fragment">
          <h2 class="heading -gamma">Basic Info</h2>
          <div class="wrapper">
            {{ '<a class="button -link" href="' . URL::route('profile.edit', Auth::user()->id) . '">Something wrong? Edit<span class="icon icon-edit"></span></a>' }}
            <dl>
              @foreach ($profile as $key => $field)
                @if (!empty($field))
                 <dt><strong>{{ snakeCaseToTitleCase($key) }}</strong></dt>
                 <dd>{{ $field }}</dd>
                @endif
              @endforeach
            </dl>
          </div>
        </div>

        <div class="fragment">
          <h2 class="heading -gamma">Application</h2>
          <div class="wrapper">
            {{ '<a class="button -link" href="' . URL::route('application.edit', Auth::user()->id) . '">Something wrong? Edit<span class="icon icon-edit"></span></a>' }}
            <dl>
              @foreach ($application as $key => $field)
                {{-- did they have a value in the field --}}
                @if (!empty($field))
                  {{-- does the field have a better title in the scholarship? --}}
                  @if (isset($scholarship[$key]))
                    <dt><strong>{{ snakeCaseToTitleCase($scholarship[$key]) }} </strong></dt>
                  @else
                    <dt><strong>{{ snakeCaseToTitleCase($key) }}</strong></dt>
                  @endif
                  <dd>{{ $field }}</dd>
                @endif
              @endforeach
            </dl>
          </div>
        </div>


      {{ Form::open(['route' => 'review.store', 'class' => 'fragment']) }}

        {{-- Checklist --}}
        <div class="field-group -checkbox">
          {{ Form::checkbox('documentation', 1, false, ['id' => 'eligibility']); }}
          {{ Form::label('documentation', "If you are chosen as a winner, you will submit a copy of your driver's license, birth certificate or passport as proof of age and U.S. citizenship/permanent legal resident status.") }}
          {{ errorsFor('documentation', $errors); }}
        </div>

        <div class="field-group -checkbox">
          {{ Form::checkbox('factual', 1, false, ['id' => 'eligibility']); }}
          {{ Form::label('factual', "You confirm that everything written in the application is true and factual.") }}
          {{ errorsFor('factual', $errors); }}
        </div>

        <div class="field-group -checkbox">
          {{ Form::checkbox('media_release', 1, false, ['id' => 'eligibility']); }}
          {{ Form::label('media_release', $global_vars->company_name . " and TMI may use your application in any media or public relations campaigns.") }}
          {{ errorsFor('media_release', $errors); }}
        </div>

        <div class="field-group -checkbox">
          {{ Form::checkbox('rules', 1, false, ['id' => 'eligibility']); }}
          {{ Form::label('rules', "You agree to the ") }} {{ link_to($global_vars->official_rules_url, 'Official Rules', ['target' => '_blank']) }}
          {{ errorsFor('rules', $errors); }}
        </div>

        <div class="field-group -action">
          {{ Form::submit('Submit application', ['class' => 'button -default', 'name' => 'complete']) }}
        </div>

      {{ Form::close() }}

      <div class="contact">
        <p>Need help? <a href="mailto:{{Config::get('mail.from.address')}}">Contact Us</a></p>
      </div>

      </div>
    </section>

  </article>
@stop
