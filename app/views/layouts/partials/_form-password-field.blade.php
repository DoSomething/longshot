<div class="field-group {{ setInvalidClass('password', $errors) }}">
  {{ Form::label('password', 'Password: ') }}
  {{ Form::password('password') }}
  {{ errorsFor('password', $errors); }}
</div>
