@extends('layouts.admin')

@section('header')

Registration

@endsection

@section('content')

<div class="container">

<div class="row bg-light">

	<div class="panel mx-auto">

		<div class="panel-heading text-center my-5">
			<h3>New Registration</h3>
		</div>

		<div class="panel-body">
					
			{!! Form::open(['method' => 'POST', 'action' => 'AdminRegistrationsController@store']) !!}

				<div class="form-group {{$errors->has('type_id') ? 'has-error' : '' }} row">			
					{!! Form::label('type_id', 'Type:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('type_id', array('' => 'Choose type') + $types, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('type_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('regNumber') ? 'has-error' : '' }} row">			
					{!! Form::label('regNumber', 'Reg #:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('regNumber', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('regNumber') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('lastName') ? 'has-error' : '' }} row">			
					{!! Form::label('lastName', 'Last Name:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('lastName', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('lastName') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('firstName') ? 'has-error' : '' }} row">			
					{!! Form::label('firstName', 'First Name:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('firstName', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('firstName') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('fLastName') ? 'has-error' : '' }} row">			
					{!! Form::label('fLastName', 'Father Last Name:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('fLastName', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('fLastName') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('fFirstName') ? 'has-error' : '' }} row">			
					{!! Form::label('fFirstName', 'Father First Name:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('fFirstName', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('fFirstName') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('mLastName') ? 'has-error' : '' }} row">		
					{!! Form::label('mLastName', 'Mother Last Name:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('mLastName', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('mLastName') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('mFirstName') ? 'has-error' : '' }} row">			
					{!! Form::label('mFirstName', 'Mother First Name:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('mFirstName', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('mFirstName') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('dob') ? 'has-error' : '' }} row">			
					{!! Form::label('dob', 'Date of Birth:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::date('dob', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('dob') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('birthPlace') ? 'has-error' : '' }} row">			
					{!! Form::label('birthPlace', 'Place of Birth:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('birthPlace', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('birthPlace') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('phoneOne') ? 'has-error' : '' }} row">			
					{!! Form::label('phoneOne', 'Phone #1:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('phoneOne', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('phoneOne') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('gender') ? 'has-error' : '' }} row">			
					{!! Form::label('gender', 'Gender:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('gender', ['' => 'Choose gender', 'Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('gender') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('idNumber') ? 'has-error' : '' }} row">			
					{!! Form::label('idNumber', 'ID:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('idNumber', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('idNumber') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('degree_id') ? 'has-error' : '' }} row">			
					{!! Form::label('degree_id', 'Education:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('degree_id', array('' => 'Choose education') + $degrees, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('degree_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('school') ? 'has-error' : '' }} row">			
					{!! Form::label('school', 'School:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('school', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('school') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('maritalStatus') ? 'has-error' : '' }} row">			
					{!! Form::label('maritalStatus', 'Marital Status:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('maritalStatus', array('' => 'Choose marital status', 'Married' => 'Married', 'Single' => 'Single', 'Divorced' => 'Divorced', 'Widow' => 'Widow'), null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('maritalStatus') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('email') ? 'has-error' : '' }} row">			
					{!! Form::label('email', 'E-Mail Address:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('email', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('email') }}</span>
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
					<div class="col-6">
					{!! Form::select('district_id', array('' => 'Choose district') + $districts, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('district_id') }}</span>
					</div>
					<div class="col-2">
                    <span id="loader_district"><i class="fa fa-repeat fa-1x fa-spin"></i></span>
                  	</div>
				</div>

				<div class="form-group {{$errors->has('sector_id') ? 'has-error' : '' }} row">			
					{!! Form::label('sector_id', 'Sector:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-6">
					{!! Form::select('sector_id', array('' => 'Choose sector') + $sectors, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('sector_id') }}</span>
					</div>
					<div class="col-2">
                    <span id="loader_sector"><i class="fa fa-repeat fa-1x fa-spin"></i></span>
                  </div>					
				</div>

				<div class="form-group {{$errors->has('cell_id') ? 'has-error' : '' }} row">			
					{!! Form::label('cell_id', 'Cell:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-6">
					{!! Form::select('cell_id', array('' => 'Choose cell') + $cells, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('cell_id') }}</span>
					</div>
					<div class="col-2">
                    <span id="loader_cell"><i class="fa fa-repeat fa-1x fa-spin"></i></span>
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
					<span class="text-danger">{{ $errors->first('regNumber') }}</span>
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
					<span class="text-danger">{{ $errors->first('regNumber') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('ownsHouse') ? 'has-error' : '' }} row">
					<div class="col-4">
						Owns House:
					</div>
					<div class="col-8">						
						<div class="form-check form-check-inline">
							<label class="form-check-label">
							{!! Form::radio('ownsHouse', true, null, ['class' => 'form-check-input']) !!} Yes</label>
						</div>
						<div class="form-check form-check-inline">
							<label class="form-check-label">
							{!! Form::radio('ownsHouse', 0, null, ['class' => 'form-check-input']) !!} No</label>
						</div>										
						<span class="text-danger">{{ $errors->first('ownsHouse') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('job') ? 'has-error' : '' }} row">			
					{!! Form::label('job', 'Job:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('job', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('job') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('employer') ? 'has-error' : '' }} row">			
					{!! Form::label('employer', 'Employer:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('employer', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('employer') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('jobLocation') ? 'has-error' : '' }} row">			
					{!! Form::label('jobLocation', 'Job Location:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('jobLocation', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('jobLocation') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('baptismDate') ? 'has-error' : '' }} row">			
					{!! Form::label('baptismDate', 'Baptism Date:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::date('baptismDate', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('baptismDate') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('baptismParish') ? 'has-error' : '' }} row">			
					{!! Form::label('baptismParish', 'Baptism Parish:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('baptismParish', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('baptismParish') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('duty_id') ? 'has-error' : '' }} row">			
					{!! Form::label('duty_id', 'Duty:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('duty_id', array('' => 'Choose duty') + $duties, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('duty_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('category_id') ? 'has-error' : '' }} row">			
					{!! Form::label('category_id', 'Category:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('category_id', array('' => 'Choose category') + $categories, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('category_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('service_id') ? 'has-error' : '' }} row">			
					{!! Form::label('service_id', 'Service:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('service_id', array('' => 'Choose service') + $services, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('service_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('commission_id') ? 'has-error' : '' }} row">			
					{!! Form::label('commission_id', 'Commission:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('commission_id', array('' => 'Choose commission') + $commissions, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('commission_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('choir_id') ? 'has-error' : '' }} row">			
					{!! Form::label('choir_id', 'Choir:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('choir_id', array('' => 'Choose choir') + $choirs, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('choir_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('status_id') ? 'has-error' : '' }} row">			
					{!! Form::label('status_id', 'Status:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('status_id', array('' => 'Choose status') + $statuses, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('status_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('confirmed') ? 'has-error' : '' }} row">
					<div class="col-4">
						Confirmed:
					</div>
					<div class="col-8">						
						<div class="form-check form-check-inline">
							<label class="form-check-label">
							{!! Form::radio('confirmed', true, null, ['class' => 'form-check-input']) !!} Yes</label>
						</div>
						<div class="form-check form-check-inline">
							<label class="form-check-label">
							{!! Form::radio('confirmed', 0, null, ['class' => 'form-check-input']) !!} No</label>
						</div>										
						<span class="text-danger">{{ $errors->first('confirmed') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('notes') ? 'has-error' : '' }} row">			
					{!! Form::label('notes', 'Notes:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">						
					{!! Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '3']) !!}
					<span class="text-danger">{{ $errors->first('notes') }}</span>
					</div>
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

@section('scripts')

<script type="text/javascript" src="{{ asset('js/getparams.js') }}"></script>

@endsection