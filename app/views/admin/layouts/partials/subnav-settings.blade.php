<div class="col-sm-3 col-md-2 sidebar">
  <ul class="nav nav-sidebar">
    <li class="{{ setActive('settings', 2, 'active') }}">{{ link_to_route('settings', 'Overview') }}</li>
    <li class="{{ setActive('appearance', 2, 'active') }}">{{ link_to_route('appearance.edit', 'Appearance') }}</li>
    <li class="{{ setActive('scholarship', 2, 'active') }}">{{ link_to_route('admin.scholarship.index', 'Scholarship') }}</li>
  </ul>
</div>
