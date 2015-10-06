@extends('admin.layouts.master')

@section('main_content')
	<div class="container-fluid">
		<div class="row">
			
			@include('admin.layouts.partials.subnav-settings')

			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<h1 class="page-header">
					New Admin
				</h1>

				{{ Form::open(['route' => 'admin.manage.store', 'class' => 'col-md-8']) }}

					{{-- First Name Field --}}
						<div class="form-group">
							{{ Form::label('first_name', 'First Name: ') }}
							{{ Form::text('first_name', null, ['class' => 'form-control']) }}
							{{ errorsFor('first_name', $errors); }}
						</div>

					{{-- Last Name Field --}}
						<div class="form-group">
							{{ Form::label('last_name', 'Last Name: ') }}
							{{ Form::text('last_name', null, ['class' => 'form-control']) }}
							{{ errorsFor('last_name', $errors); }}
						</div>

					{{-- Email Field --}}
						<div class="form-group">
							{{ Form::label('email', 'Email: ') }}
							{{ Form::text('email', null, ['class' => 'form-control']) }}
							{{ errorsFor('email', $errors); }}
						</div>

					{{-- Password Field --}}
						<div class="form-group">
							{{ Form::label('password', 'Password: ') }}
							{{ Form::password('password', ['class' => 'form-control']) }}
							{{ errorsFor('password', $errors); }}
						</div>

					{{-- Password Confirmation Field --}}
						<div class="form-group">
							{{ Form::label('password_confirmation', 'Confirm Password: ') }}
							{{ Form::password('password_confirmation', ['class' => 'form-control']) }}
						</div>

					{{-- Save Button --}}
						<div>
							{{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
						</div>

				{{ Form::close() }}


			</div>	


		</div>
	</div>
@stop