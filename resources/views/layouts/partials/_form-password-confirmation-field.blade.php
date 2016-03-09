<div class="field-group {{ setInvalidClass('password', $errors) }}">
  {!! Form::label('password_confirmation', 'Confirm Password: ') !!}
  {!! Form::password('password_confirmation') !!}
</div>
