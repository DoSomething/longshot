<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      {{ '<a class="navbar-brand" href="' . URL::route('home', null) . '" title="View live site"><span class="glyphicon glyphicon-globe"></span> Scholarship App</a>' }}
    </div>

    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li>{{ link_to_route('admin', 'Dashboard') }}</li>
        <li>{{ link_to_route('settings', 'Settings') }}</li>
        <li>{{ link_to_route('applications.index', 'Applications') }}</li>
        <li>{{ link_to_route('admin.page.index', 'Pages') }}</li>
        <li>{{ link_to_route('logout', 'Log out') }}</li>
      </ul>
    </div>

  </div>
</div>
