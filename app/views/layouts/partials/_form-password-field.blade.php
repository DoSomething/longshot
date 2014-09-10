<div class="field-group">
  {{ Form::label('password', 'Password: ') }}
  {{ Form::password('password') }}
  {{ errorsFor('password', $errors); }}
</div>
