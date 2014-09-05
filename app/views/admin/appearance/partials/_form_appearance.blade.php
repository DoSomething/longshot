@foreach($settings as $setting)

  {{-- Color Setting Type --}}
  @if($setting->type === 'color')
    <div class="form-group">
      {{ Form::label($setting->key, snakeCaseToTitleCase($setting->key) . ': ') }}
      @if($setting->description)
      <p><em class="text-muted">{{ $setting->description }}</em></p>
      @endif
      <div class="input-group">
        <div class="input-group-addon">#</div>
        {{ Form::text($setting->key, $setting->value, ['class' => 'form-control', 'placeholder' => '6-digit hexadecimal color']) }}
      </div>
      {{ errorsFor($setting->key, $errors); }}
    </div>
  @endif

@endforeach
