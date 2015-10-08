<div class="field-group {{ setInvalidClass('password', $errors) }}">
  {{ Form::label('password', 'Password: ') }}
  {{ Form::password('password', array('placeholder' => 'Must be at least six characters')) }}
  {{ errorsFor('password', $errors); }}
</div>
