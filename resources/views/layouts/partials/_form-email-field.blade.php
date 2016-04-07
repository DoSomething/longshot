<div class="field-group {{ setInvalidClass('email', $errors) }}">
  {!! Form::label('email', 'Email: ') !!}
  {!! Form::email('email', null, ['required' => 'true']) !!}
  {!! errorsFor('email', $errors) !!}
</div>
