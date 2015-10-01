@extends('admin.layouts.master')

@section('main_content')
	<div class="container-fluid">
		<div class="row">
			
			@include('admin.layouts.partials.subnav-settings')

			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<h1 class="page-header">
					New Admin
				</h1>

				{{ Form::open(['route' => 'admin.manage.store']) }}

				   {{-- First Name Field --}}
			          <div class="form-group">
			            {{ Form::label('first_name', 'First Name: ') }}
			            {{ Form::text('first_name') }}
			            {{ errorsFor('first_name', $errors); }}
			          </div>

			          {{-- Last Name Field --}}
			          <div class="form-group -dual -beta {{ setInvalidClass('last_name', $errors) }}">
			            {{ Form::label('last_name', 'Last Name: ') }}
			            {{ Form::text('last_name') }}
			            {{ errorsFor('last_name', $errors); }}
			          </div>

			          {{-- Email Field --}}
			          @include('layouts/partials/_form-email-field')

			          {{-- Password Field --}}
			          @include('layouts/partials/_form-password-field')

			          {{-- Password Confirmation Field --}}
			          @include('layouts/partials/_form-password-confirmation-field')


					{{-- Save Button --}}
					<div>
						{{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
					</div>

				{{ Form::close() }}


			</div>	


		</div>
	</div>
@stop