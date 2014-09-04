

  {{-- Title --}}
  <div class="field-group">
    {{ Form::label('title', 'Title: ') }}
    {{ Form::text('title') }}
    {{ errorsFor('title', $errors); }}
  </div>

    {{-- Body --}}
  <div class="field-group">
    {{ Form::label('body', 'Body: ') }}
    {{ Form::textarea('body') }}
    {{ errorsFor('body', $errors); }}
  </div>

     {{-- Hero Image --}}
  <div class="field-group">
    {{ Form::label('hero_image', 'Hero Image: ') }}
    {{ Form::text('hero_image') }}
    {{ errorsFor('hero_image', $errors); }}
  </div>
