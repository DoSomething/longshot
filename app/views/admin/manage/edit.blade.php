@extends('admin.layouts.master')

@section('main_content')
	<div class="container-fluid">
		<div class="row">
			
			@include('admin.layouts.partials.subnav-settings')

			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<h1 class="page-header">
					Admin: {{ $admin->first_name . ' ' . $admin->last_name }}
				</h1>

				{{ Form::model($admin, ['method' => 'PATCH', 'route' => ['admin.winner.update', $admin->id], 'class' => 'col-md-8']) }}

					<div class="form-group">
						{{ Form::label('email', 'Email: ') }}
						{{ Form::text('email', $admin->email, ['class' => 'form-control']) }}
					</div>

					<div class="form-group">
						{{ Form::label('first_name', 'First Name: ') }}
						{{ Form::text('first_name', $admin->first_name, ['class' => 'form-control']) }}
					</div>

					<div class="form-group">
						{{ Form::label('last_name', 'Last Name: ') }}
						{{ Form::text('last_name', $admin->last_name, ['class' => 'form-control']) }}
					</div>


					{{-- Save Button --}}
					<div>
						{{ Form::submit('Save', ['class' => 'btn btn-primary']) }}
					</div>

					<hr />

				{{ Form::close() }}

				{{ Form::model($admin, ['method' => 'delete', 'route' => ['admin.manage.destroy', $admin->id], 'class' => 'col-md-8']) }}
	
					{{-- Delete Button --}}
					<div>
						{{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
					</div>

				{{ Form::close() }}

			</div>	


		</div>
	</div>
@stop