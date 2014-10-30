@if (!empty($vars->open_graph_data_title))
  <meta property="og:title" content="{{ $vars->open_graph_data_title }}">
@endif

@if (!empty($vars->open_graph_data_description))
  <meta property="og:description" content="{{ $vars->open_graph_data_description }}">
@endif

@if (!empty($vars->open_graph_data_type))
  <meta property="og:type" content="{{ $vars->open_graph_data_type }}">
@endif

@if (!empty($vars->open_graph_data_url))
  <meta property="og:url" content="{{ $vars->open_graph_data_url }}">
@endif

@if (!empty($vars->open_graph_data_url) && !empty($vars->open_graph_data_image))
  <meta property="og:image" content="{{ $vars->open_graph_data_url . $vars->open_graph_data_image }}">
@endif
