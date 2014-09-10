<div class="field-group">
  {{ Form::label('email', 'Email: ') }}
  {{ Form::email('email', null, ['required' => 'true']) }}
  {{ errorsFor('email', $errors); }}
</div>
