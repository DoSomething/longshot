@foreach ($settings as $setting)

  {{-- Text Setting Type --}}
  @if ($setting->type === 'text')
    <div class="form-group">
      {!! Form::label($setting->key, snakeCaseToTitleCase($setting->key) . ': ') !!}
      @if ($setting->description)
        <p><em class="text-muted">{{ $setting->description }}</em></p>
      @endif
      {!! Form::text($setting->key, $setting->value, ['class' => 'form-control', 'placeholder' => 'enter value']) !!}
      {!! errorsFor($setting->key, $errors); !!}
    </div>
  @endif


  {{-- Textarea Setting Type --}}
  @if ($setting->type === 'textarea')
    <div class="form-group">
      {!! Form::label($setting->key, snakeCaseToTitleCase($setting->key) . ': ') !!}
      @if ($setting->description)
        <p><em class="text-muted">{{ $setting->description }}</em></p>
      @endif
      {!! Form::textarea($setting->key, $setting->value, ['class' => 'form-control', 'placeholder' => 'enter value', 'rows' => '5']) !!}
      {!! errorsFor($setting->key, $errors); !!}
    </div>
  @endif


  {{-- Color Setting Type --}}
  @if ($setting->type === 'color')
    <div class="form-group">
      {!! Form::label($setting->key, snakeCaseToTitleCase($setting->key) . ': ') !!}
      @if ($setting->description)
        <p><em class="text-muted">{{ $setting->description }}</em></p>
      @endif
      <div class="input-group">
        <div class="input-group-addon">#</div>
        {!! Form::text($setting->key, $setting->value, ['class' => 'form-control', 'placeholder' => '6-digit hexadecimal color']) !!}
      </div>
      {!! errorsFor($setting->key, $errors); !!}
    </div>
  @endif


  {{-- Image Setting Type --}}
  @if ($setting->type === 'image')
    <div class="form-group">
      {!! Form::label($setting->key, snakeCaseToTitleCase($setting->key) . ': ') !!}
      @if ($setting->description)
        <p><em class="text-muted">{{ $setting->description }}</em></p>
      @endif

      @if (!empty($setting->value))
        <div class="image-holder">
          <img src="{{ asset_url($setting->value) }}" alt="uploaded image">
        </div>
        @if ($setting->key === 'background_image')
          {!! Form::label('Remove?') !!}
          {!! Form::checkbox('remove_background_image') !!}
        @endif
      @endif

      {!! Form::file($setting->key) !!}
      {!! errorsFor($setting->key, $errors); !!}
    </div>
  @endif

@endforeach
