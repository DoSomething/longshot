<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li class="{{ Request::is('admin/applications') ? 'active' : '' }}">{!! link_to_route('applications.index', 'Overview') !!}</li>
    <li class="{{ Request::is('admin/applications/export') ? 'active' : '' }}">{!! link_to_route('export', 'Export') !!}</li>
  </ul>
</div>
