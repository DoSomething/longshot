@if (isset($global_vars->open_graph_data_title))
  <meta property="og:title" content="{{ $global_vars->open_graph_data_title }}">
@endif

@if (isset($global_vars->open_graph_data_description))
  <meta property="og:description" content="{{ $global_vars->open_graph_data_description }}">
@endif

@if (isset($global_vars->open_graph_data_type))
  <meta property="og:type" content="{{ $global_vars->open_graph_data_type }}">
@endif

@if (isset($global_vars->open_graph_data_url))
  <meta property="og:url" content="{{ $global_vars->open_graph_data_url }}">
@endif

@if (isset($global_vars->open_graph_data_url) && isset($global_vars->open_graph_data_image))
  <meta property="og:image" content="{{ $global_vars->open_graph_data_url . $global_vars->open_graph_data_image }}">
@endif
