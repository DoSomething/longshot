<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li class="{{ setActive('general', 3, 'active') }}">{!! link_to_route('general.edit', 'General') !!}</li>
    <li class="{{ setActive('appearance', 3, 'active') }}">{!! link_to_route('appearance.edit', 'Appearance') !!}</li>
    <li class="{{ setActive('meta-data', 3, 'active') }}">{!! link_to_route('meta-data.edit', 'Meta Data') !!}</li>
    <li class="{{ setActive('scholarship', 2, 'active') }}">{!! link_to_route('admin.scholarship.index', 'Scholarships') !!}</li>
    <li class="{{ setActive('winners', 3, 'active') }}">{!! link_to_route('admin.winner.index', 'Winners') !!}</li>
    <li class="{{ setActive('email', 2, 'active') }}">{!! link_to_route('emails', 'Emails') !!}</li>
  </ul>
  {!! Form::open(array('route' => 'general.clear-cache')) !!}
    {!! Form::submit('Clear Cache', ['class' => 'btn btn-default -hover-red']) !!}
  {!! Form::close() !!}
</div>
