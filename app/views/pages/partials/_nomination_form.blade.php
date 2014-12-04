<section id="nominate" class="segment segment--nominate">
  <div class="wrapper">
    <h1 class="__title heading -alpha -alt">Nominate A Star</h1>

    @if (isset($vars->nominate_text))
      <p class="__message">{{ $vars->nominate_text }}</p>
    @endif

    {{ Form::open(['route' => 'nomination.create']) }}

      <div class="fragment -alpha">
        <h2 class="heading -delta">Your Info</h2>

        {{-- Nominator Name --}}
        <div class="field-group">
          {{ Form::label('rec_name', 'Your Name: ') }}
          {{ Form::text('rec_name') }}
          {{ errorsFor('rec_name', $errors); }}
        </div>

        {{-- Nominator Email --}}
        <div class="field-group">
          {{ Form::label('rec_email', 'Your Email: ') }}
          {{ Form::email('rec_email') }}
          {{ errorsFor('rec_email', $errors); }}
        </div>
      </div>

      <div class="fragment -beta">
        <h2 class="heading -delta">Their Info</h2>

        {{-- Nominatee Name --}}
        <div class="field-group">
          {{ Form::label('nom_name', 'Their Name: ') }}
          {{ Form::text('nom_name') }}
          {{ errorsFor('nom_name', $errors); }}
        </div>

        {{-- Nominatee Email --}}
        <div class="field-group">
          {{ Form::label('nom_email', 'Their Email: ') }}
          {{ Form::email('nom_email') }}
          {{ errorsFor('nom_email', $errors); }}
        </div>
      </div>

      <div class="field-group -action">
        {{ Form::submit('Nominate', ['class' => 'button -default']) }}
      </div>

    {{ Form::close() }}
  </div>

  @if (isset($vars->nominate_image))
    <div class="__image" style="background-image: url('{{ $vars->nominate_image or '/dist/images/nominate-image-placeholder.jpg' }}');"></div>
  @endif
</section>