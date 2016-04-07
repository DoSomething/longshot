 <div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$class}}{{ $key }}">
        {{$email_key = $email['key']}}
      </a>
    </h4>
  </div>
  <div id="collapse-{{$class}}{{ $key }}" class="panel-collapse collapse">
    <div class="panel-body">
      {!! Form::hidden($email_key . $class .'[id]', $email['id']) !!}
      {!! Form::label($email_key . $class .'[subject]', 'Email Subject: ') !!}
      {!! Form::text($email_key . $class .'[subject]', $email['subject'], ['class' => 'form-control']) !!}
      {!! Form::label($email_key . $class .'[body]', 'Email Body: ') !!}
      {!! Form::textarea($email_key . $class .'[body]', $email['body'], ['class' => 'form-control']) !!}
      </div>
    </div>
  </div>