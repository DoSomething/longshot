@extends('admin.layouts.master')

@section('main_content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">All Static Pages</h1>
        <div class="table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Created</th>
                <th>Updated</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pages as $page)
                <tr>
                  <td>{{ $page->id }}</td>
                  <td>{{ link_to('admin/page/' . $page->id . '/edit' , $page->title) }}</td>
                  <td>{{ $page->created_at }}</td>
                  <td>{{ $page->updated_at }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>

    </div>
  </div>
@stop
