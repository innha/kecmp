@extends('layouts.admin')

@section('header')

User

@endsection

@section('content')

<div class="container">

<div class="row bg-light">

	<div class="panel mx-auto">

		<div class="panel-heading text-center my-5">
			<h3>New User</h3>
		</div>

		<div class="panel-body">
					
			{!! Form::open(['method' => 'POST', 'action' => 'AdminUsersController@store', 'files' => true]) !!}

				<div class="form-group row">			
					{!! Form::label('role_id', 'Role:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('role_id', array('' => 'Choose role') + $roles, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('role_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('privilege_id') ? 'has-error' : '' }} row">			
					{!! Form::label('privilege_id', 'Privilege:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('privilege_id', array('' => 'Choose privilege') + $privileges, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('privilege_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('name') ? 'has-error' : '' }} row">			
					{!! Form::label('name', 'Name:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('name', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('name') }}</span>
					</div>
				</div>				

				<div class="form-group {{$errors->has('email') ? 'has-error' : '' }} row">			
					{!! Form::label('email', 'E-Mail Address:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('email', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('email') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('phone') ? 'has-error' : '' }} row">			
					{!! Form::label('phone', 'Phone:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('phone', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('phone') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('password') ? 'has-error' : '' }} row">			
					{!! Form::label('password', 'Password:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::password('password', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('password') }}</span>
					</div>
				</div>				

				<div class="form-group {{$errors->has('password_confirmation') ? 'has-error' : '' }} row">			
					{!! Form::label('password_confirmation', 'Confirm Password:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::password('password_confirmation', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
					</div>
				</div>				

				<div class="form-group {{$errors->has('province_id') ? 'has-error' : '' }} row">			
					{!! Form::label('province_id', 'Province:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('province_id', array('' => 'Choose province') + $provinces, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('province_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('district_id') ? 'has-error' : '' }} row">			
					{!! Form::label('district_id', 'District:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('district_id', array('' => 'Choose district') + $districts, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('district_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('sector_id') ? 'has-error' : '' }} row">			
					{!! Form::label('sector_id', 'Sector:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('sector_id', array('' => 'Choose sector') + $sectors, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('sector_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('cell_id') ? 'has-error' : '' }} row">			
					{!! Form::label('cell_id', 'Cell:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('cell_id', array('' => 'Choose cell') + $cells, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('cell_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('village_id') ? 'has-error' : '' }} row">			
					{!! Form::label('village_id', 'Village:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('village_id', array('' => 'Choose village') + $villages, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('village_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('diocese_id') ? 'has-error' : '' }} row">			
					{!! Form::label('diocese_id', 'Diocese:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('diocese_id', array('' => 'Choose diocese') + $dioceses, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('diocese_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('parish_id') ? 'has-error' : '' }} row">			
					{!! Form::label('parish_id', 'Parish:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('parish_id', array('' => 'Choose parish') + $parishes, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('parish_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('chapelle_id') ? 'has-error' : '' }} row">			
					{!! Form::label('chapelle_id', 'Chapelle:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('chapelle_id', array('' => 'Choose chapelle') + $chapelles, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('chapelle_id') }}</span>
				</div>
				</div>

				<div class="form-group {{$errors->has('zone_id') ? 'has-error' : '' }} row">			
					{!! Form::label('zone_id', 'Zone:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('zone_id', array('' => 'Choose zone') + $zones, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('zonde_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('is_active') ? 'has-error' : '' }} row">
					<div class="col-4">
						Status:
					</div>
					<div class="col-8">						
						<div class="form-check form-check-inline">
							<label class="form-check-label">
							{!! Form::radio('is_active', true, null, ['class' => 'form-check-input']) !!} Active</label>
						</div>
						<div class="form-check form-check-inline">
							<label class="form-check-label">
							{!! Form::radio('is_active', false, null, ['class' => 'form-check-input']) !!} Inactive</label>
						</div>
						<span class="text-danger">{{ $errors->first('is_active') }}</span>
					</div>
				</div>	

				<div class="form-group {{$errors->has('photo_id') ? 'has-error' : '' }} row">					
			
					{!! Form::label('photo_id', 'Photo') !!}
					{!! Form::file('photo_id', ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('photo_id') }}</span>
			
				</div>							

				<div class="form-group">
					<div class="text-center">
					{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

</div>
@endsection