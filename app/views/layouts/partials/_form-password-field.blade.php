<div class="field-group {{ setInvalidClass('password', $errors) }}">
  {{ Form::label('password', 'Password: ') }}
  {{ Form::password('password', array('placeholder' => 'Password must be at least six characters long')) }}
  {{ errorsFor('password', $errors); }}
</div>
