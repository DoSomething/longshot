@extends('admin.layouts.master')

@section('main_content')
	<div class="container-fluid">
		<div class="row">
			
			@include('admin.layouts.partials.subnav-settings')

			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<h1 class="page-header">Manage Administrators</h1>

				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>User ID</th>
							</tr>
						</thead>

						<tbody>
							@foreach ($admins as $admin)
							<tr>
								<td>{{ link_to_route('admin.manage.edit', $admin->first_name . ' ' . $admin->last_name, [$admin->id]) }}</td>
								<td>{{ $admin->email }}</td>
								<td>{{ $admin->id }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>

				{{-- Create New Admin Button --}}

					<div>
						<a class='btn btn-primary' href="{{ URL::route('admin.manage.create') }}">Create New Admin </a>
					</div>


			</div>

		</div>
	</div>
@stop
