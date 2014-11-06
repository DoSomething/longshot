<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li class="{{ setActive('applications', 2, 'active') }}">{{ link_to_route('applications.index', 'Overview') }}</li>
    <li class="{{ setActive('export', 3, 'active') }}">{{ link_to_route('export', 'Export') }}</li>
  </ul>
</div>
