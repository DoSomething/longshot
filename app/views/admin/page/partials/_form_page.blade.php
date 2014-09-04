

  {{-- Title --}}
  <div class="field-group">
    {{ Form::label('title', 'Title: ') }}
    {{ Form::text('title') }}
    {{ errorsFor('title', $errors); }}
  </div>

    {{-- Description --}}
  <div class="field-group">
    {{ Form::label('description', 'Description: ') }}
    {{ Form::textarea('description') }}
    {{ errorsFor('description', $errors); }}
  </div>

     {{-- Hero Image --}}
  <div class="field-group">
    {{ Form::label('hero_image', 'Hero Image: ') }}
    {{ Form::file('hero_image') }}
    {{ errorsFor('hero_image', $errors); }}
  </div>
