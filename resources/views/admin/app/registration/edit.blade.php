@extends('layouts.admin')

@section('header')

{{-- dd($errors->all()) --}}

Registration

<div>{{-- $registration->status->id --}}</div>

<div class="text-danger"><span>{{ count($errors) > 0 ? 'There are errors in your form. Check and try again' : '' }}</span></div>

@endsection

@section('content')

<div class="container">

	{!! Form::model($registration, ['method' => 'PATCH', 'action' => ['AdminRegistrationsController@update', $registration->id]]) !!}

	<div class="panel-group" id="registration-accordion" role="tablist" aria-multiselectable="true">
		<div class="panel panel-default personal-panel card" id="panel-personal">
			<div class="panel-heading personal-heading card-header" role="tab" data-toggle="collapse" data-parent="#registration-accordion" href="#collapse-personal">
      			<h4 class="panel-title personal-acc-title mb-0"> <a class="accordion-personal" data-toggle="collapse" data-parent="#registration-accordion" href="#collapse-personal">Personal info</a>
      			</h4>
		
      		</div>
    		<div id="collapse-personal" class="panel-collapse details collapse in">
      			<div class="panel-body personal-inside p-3">
					{{--						
					<div class="form-group{{$errors->has('type_id') ? ' has-error' : '' }} row">			
						{!! Form::label('type_id', 'Type:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('type_id', array('' => 'Choose type') + $types, null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('type_id') }}</span>
						</div>
					</div>					

					<div class="form-group{{$errors->has('regNumber') ? ' has-error' : '' }} row">
						{!! Form::label('regNumber', 'Reg #:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::text('regNumber', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('regNumber') }}</span>
						</div>
					</div>
					--}}      				
					
					<div class="form-group{{$errors->has('lastName') ? ' has-error' : '' }} row">			
						{!! Form::label('lastName', 'Last Name:', ['class' => 'col-sm-4 col-form-label col-form-label-xs']) !!}
						<div class="col-md-8">
						{!! Form::text('lastName', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('lastName') }}</span>
						</div>
					</div>
					
					<div class="form-group{{$errors->has('firstName') ? ' has-error' : '' }} row">			
						{!! Form::label('firstName', 'First Name:', ['class' => 'col-sm-4 col-form-label col-form-label-xs']) !!}
						<div class="col-md-8">
						{!! Form::text('firstName', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('firstName') }}</span>
						</div>
					</div>
					
					<div class="form-group{{$errors->has('fLastName') ? ' has-error' : '' }} row">			
						{!! Form::label('fLastName', 'Father Last:', ['class' => 'col-sm-4 col-form-label col-form-label-xs']) !!}
						<div class="col-md-8">
						{!! Form::text('fLastName', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('fLastName') }}</span>
						</div>
					</div>
					
					<div class="form-group{{$errors->has('fFirstName') ? ' has-error' : '' }} row">			
						{!! Form::label('fFirstName', 'Father First:', ['class' => 'col-sm-4 col-form-label col-form-label-xs']) !!}
						<div class="col-md-8">
						{!! Form::text('fFirstName', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('fFirstName') }}</span>
						</div>
					</div>
					
					<div class="form-group{{$errors->has('mLastName') ? ' has-error' : '' }} row">			
						{!! Form::label('mLastName', 'Mother Last:', ['class' => 'col-sm-4 col-form-label col-form-label-xs']) !!}
						<div class="col-md-8">
						{!! Form::text('mLastName', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('mLastName') }}</span>
						</div>
					</div>
					
					<div class="form-group{{$errors->has('mFirstName') ? ' has-error' : '' }} row">			
						{!! Form::label('mFirstName', 'Mother First:', ['class' => 'col-sm-4 col-form-label col-form-label-xs']) !!}
						<div class="col-md-8">
						{!! Form::text('mFirstName', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('mFirstName') }}</span>
						</div>
					</div>
					
					<div class="form-group{{$errors->has('dob') ? ' has-error' : '' }} row">			
						{!! Form::label('dob', 'DOB:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::date('dob', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('dob') }}</span>
						</div>
					</div>
					
					<div class="form-group{{$errors->has('birthPlace') ? ' has-error' : '' }} row">			
						{!! Form::label('birthPlace', 'Birth place:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::text('birthPlace', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('birthPlace') }}</span>
						</div>
					</div>
					
					<div class="form-group{{$errors->has('gender') ? ' has-error' : '' }} row">			
						{!! Form::label('gender', 'Gender:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('gender', ['' => 'Choose gender', 'Male' => 'Male', 'Female' => 'Female'], null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('gender') }}</span>
						</div>
					</div>
					{{--
					<div class="form-group{{$errors->has('idNumber') ? ' has-error' : '' }} row">			
						{!! Form::label('idNumber', 'ID:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::text('idNumber', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('idNumber') }}</span>
						</div>
					</div>						
					 --}}
					<div class="form-group{{$errors->has('maritalStatus') ? ' has-error' : '' }} row">			
						{!! Form::label('maritalStatus', 'Marital Status:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('maritalStatus', array('' => 'Choose marital status', 'Married' => 'Married', 'Single' => 'Single', 'Divorced' => 'Divorced', 'Widow' => 'Widow'), null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('maritalStatus') }}</span>
						</div>
					</div>
					
					<div class="form-group{{$errors->has('ownsHouse') ? ' has-error' : '' }} row">
						<div class="col-md-3">
							Legal marriage:
						</div>
						<div class="col-sm-9">						
							<div class="form-check form-check-inline">
								<label class="form-check-label">
								{!! Form::radio('legallyMarried', true, true, ['class' => 'form-check-input']) !!} Yes</label>
							</div>
							<div class="form-check form-check-inline">
								<label class="form-check-label">
								{!! Form::radio('legallyMarried', 0, null, ['class' => 'form-check-input']) !!} No</label>
							</div>										
							<span class="text-danger">{{ $errors->first('legallyMarried') }}</span>
						</div>
					</div>					
					
					<div class="form-group{{$errors->has('ownsHouse') ? ' has-error' : '' }} row">
						<div class="col-md-3">
							Owns House:
						</div>
						<div class="col-sm-9">						
							<div class="form-check form-check-inline">
								<label class="form-check-label">
								{!! Form::radio('ownsHouse', true, true, ['class' => 'form-check-input']) !!} Yes</label>
							</div>
							<div class="form-check form-check-inline">
								<label class="form-check-label">
								{!! Form::radio('ownsHouse', 0, null, ['class' => 'form-check-input']) !!} No</label>
							</div>										
							<span class="text-danger">{{ $errors->first('ownsHouse') }}</span>
						</div>
					</div>
					
      			</div>
    		</div>
    	</div>

		<div class="panel panel-default address-panel card" id="panel-address">

			<div class="panel-heading address-heading card-header" data-toggle="collapse" data-parent="#registration-accordion" href="#collapse-address">
      			<h4 class="panel-title address-acc-title mb-0"> <a class="accordion-address" data-toggle="collapse" data-parent="#registration-accordion" href="#collapse-address">Address info</a>
      			</h4>
			
      		</div>
    		<div id="collapse-address" class="panel-collapse details collapse in">
      			<div class="panel-body address-inside p-3">
					<div class="form-group{{$errors->has('phoneOne') ? ' has-error' : '' }} row">			
						{!! Form::label('phoneOne', 'Phone #1:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::text('phoneOne', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('phoneOne') }}</span>
						</div>
					</div>
			
					<div class="form-group{{$errors->has('phoneTwo') ? ' has-error' : '' }} row">
						{!! Form::label('phoneTwo', 'Phone #2:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::text('phoneTwo', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('phoneTwo') }}</span>
						</div>
					</div>
			
					<div class="form-group{{$errors->has('email') ? ' has-error' : '' }} row">			
						{!! Form::label('email', 'E-Mail:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::text('email', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('email') }}</span>
						</div>
					</div>

					<div class="form-group{{$errors->has('province_id') ? ' has-error' : '' }} row">			
						{!! Form::label('province_id', 'Province:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('province_id', array('' => 'Choose province') + $provinces, null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('province_id') }}</span>
						</div>
					</div>

					<div class="form-group{{$errors->has('district_id') ? ' has-error' : '' }} row">			
						{!! Form::label('district_id', 'District:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-md-9">
						{!! Form::select('district_id', array('' => 'Choose district') + $districts, null, ['class' => 'form-control']) !!}
							<span class="text-danger">{{ $errors->first('district_id') }}</span>
		                	<span id="loader_district"><i class="fa fa-repeat fa-1x fa-spin"></i></span>
		              	</div>
					</div>

					<div class="form-group{{$errors->has('sector_id') ? ' has-error' : '' }} row">			
						{!! Form::label('sector_id', 'Sector:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-md-9">
						{!! Form::select('sector_id', array('' => 'Choose sector') + $sectors, null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('sector_id') }}</span>
		                <span id="loader_sector"><i class="fa fa-repeat fa-1x fa-spin"></i></span>
		              </div>					
					</div>

					<div class="form-group{{$errors->has('cell_id') ? ' has-error' : '' }} row">			
						{!! Form::label('cell_id', 'Cell:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-md-9">
						{!! Form::select('cell_id', array('' => 'Choose cell') + $cells, null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('cell_id') }}</span>
		                <span id="loader_cell"><i class="fa fa-repeat fa-1x fa-spin"></i></span>
		              </div>					
					</div>

					<div class="form-group{{$errors->has('village_id') ? ' has-error' : '' }} row">			
						{!! Form::label('village_id', 'Village:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('village_id', array('' => 'Choose village') + $villages, null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('village_id') }}</span>
						</div>
					</div>						

					<div class="form-group{{$errors->has('diocese_id') ? ' has-error' : '' }} row">			
						{!! Form::label('diocese_id', 'Diocese:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('diocese_id', array('' => 'Choose diocese') + $dioceses, null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('diocese_id') }}</span>
						</div>
					</div>

					<div class="form-group{{$errors->has('parish_id') ? ' has-error' : '' }} row">			
						{!! Form::label('parish_id', 'Parish:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('parish_id', array('' => 'Choose parish') + $parishes, null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('regNumber') }}</span>
						</div>
					</div>

					<div class="form-group{{$errors->has('chapelle_id') ? ' has-error' : '' }} row">			
						{!! Form::label('chapelle_id', 'Chapelle:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('chapelle_id', array('' => 'Choose chapelle') + $chapelles, null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('chapelle_id') }}</span>
						</div>
					</div>

					<div class="form-group{{$errors->has('zone_id') ? ' has-error' : '' }} row">			
						{!! Form::label('zone_id', 'Zone:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('zone_id', array('' => 'Choose zone') + $zones, null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('regNumber') }}</span>
						</div>
					</div>
      			</div>
    		</div>
    	</div>
		
		<div class="panel panel-default professional-panel card" id="panel-professional">

			<div class="panel-heading professional-heading card-header" data-toggle="collapse" data-parent="#registration-accordion" href="#collapse-professional">
      			<h4 class="panel-title professional-acc-title mb-0"> <a class="accordion-professional" data-toggle="collapse" data-parent="#registration-accordion" href="#collapse-professional">Professional info</a>
      			</h4>

      		</div>
    		<div id="collapse-professional" class="panel-collapse details collapse in">
      			<div class="panel-body professional-inside p-3">

				<div class="form-group{{$errors->has('degree_id') ? ' has-error' : '' }} row">			
						{!! Form::label('degree_id', 'Education:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('degree_id', array('' => 'Choose education') + $degrees, null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('degree_id') }}</span>
						</div>
					</div>
					{{--
					<div class="form-group{{$errors->has('school') ? ' has-error' : '' }} row">			
						{!! Form::label('school', 'School:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::text('school', 'Apapec', ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('school') }}</span>
						</div>
					</div>						

					<div class="form-group{{$errors->has('job') ? ' has-error' : '' }} row">			
						{!! Form::label('job', 'Job:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::text('job', 1, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('job') }}</span>
						</div>
					</div>
					--}}
					
					<div class="form-group{{$errors->has('job_id') ? ' has-error' : '' }} row">			
						{!! Form::label('job_id', 'Job:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('job_id', array('' => 'Choose job') + $jobs, null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('job_id') }}</span>
						</div>
					</div>

					{{--
					<div class="form-group{{$errors->has('employer') ? ' has-error' : '' }} row">			
						{!! Form::label('employer', 'Employer:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::text('employer', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('employer') }}</span>
						</div>
					</div>

					<div class="form-group{{$errors->has('jobLocation') ? ' has-error' : '' }} row">			
						{!! Form::label('jobLocation', 'Location:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::text('jobLocation', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('jobLocation') }}</span>
						</div>
					</div>
					--}}
      			</div>
    		</div>
    	</div>    	

		<div class="panel panel-default church-panel card" id="panel-church">

			<div class="panel-heading church-heading card-header" data-toggle="collapse" data-parent="#registration-accordion" href="#collapse-church">
      			<h4 class="panel-title church-acc-title mb-0"> <a class="accordion-church" data-toggle="collapse" data-parent="#registration-accordion" href="#collapse-church">Church info</a>
      			</h4>

      		</div>
    		<div id="collapse-church" class="panel-collapse details collapse in">
      			<div class="panel-body church-inside p-3">					
      				<div class="form-group{{$errors->has('status_id') ? ' has-error' : '' }} row">			
						{!! Form::label('status_id', 'Status:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('status_id', array('' => 'Choose status') + $statuses, null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('status_id') }}</span>
						</div>
					</div>

					{{-- status-dependent forms --}}
					
					<div id="suspension" class="hidden">
						<div class="form-group {{$errors->has('date_suspended') ? 'has-error' : '' }} row">			
							{!! Form::label('date_suspended', 'Date Suspended:', ['class' => 'col-sm-3 col-form-label']) !!}
							<div class="col-sm-9">
							{!! Form::date('date_suspended', null, ['class' => 'form-control', 'id' => 'date_suspended']) !!}
							<span class="text-danger">{{ $errors->first('date_suspended') }}</span>
							</div>
						</div>				

						<div class="form-group {{$errors->has('suspendor') ? 'has-error' : '' }} row">			
							{!! Form::label('suspendor', 'Decided By:', ['class' => 'col-sm-3 col-form-label']) !!}
							<div class="col-sm-9">
							{!! Form::text('suspendor', null, ['class' => 'form-control', 'id' => 'suspendor']) !!}
							<span class="text-danger">{{ $errors->first('suspendor') }}</span>
							</div>
						</div>				

						<div class="form-group {{$errors->has('reason') ? 'has-error' : '' }} row">			
							{!! Form::label('reason', 'Reason:', ['class' => 'col-sm-3 col-form-label']) !!}
							<div class="col-sm-9">
							{!! Form::text('reason', null, ['class' => 'form-control', 'id' => 'reason']) !!}
							<span class="text-danger">{{ $errors->first('reason') }}</span>
							</div>
						</div>						
					</div>

					<div id="reinstated" class="hidden">
						<div class="form-group {{$errors->has('reinstator') ? 'has-error' : '' }} row">			
							{!! Form::label('reinstator', 'Approved By:', ['class' => 'col-sm-3 col-form-label']) !!}
							<div class="col-sm-9">
							{!! Form::text('reinstator', null, ['class' => 'form-control']) !!}
							<span class="text-danger">{{ $errors->first('reinstator') }}</span>
							</div>
						</div>

						<div class="form-group {{$errors->has('date_returned') ? 'has-error' : '' }} row">			
							{!! Form::label('date_returned', 'Date Returned:', ['class' => 'col-sm-3 col-form-label']) !!}
							<div class="col-sm-9">
							{!! Form::date('date_returned', null, ['class' => 'form-control']) !!}
							<span class="text-danger">{{ $errors->first('date_returned') }}</span>
							</div>
						</div>						
					</div>

					<div id="dead" class="hidden">					
						<div class="form-group {{$errors->has('date_died') ? 'has-error' : '' }} row">
							{!! Form::label('date_died', 'Date Died:', ['class' => 'col-sm-3 col-form-label']) !!}
							<div class="col-sm-9">
							{!! Form::date('date_died', null, ['class' => 'form-control']) !!}
							<span class="text-danger">{{ $errors->first('date_died') }}</span>
							</div>
						</div>

						<div class="form-group row">			
							{!! Form::label('date_buried', 'Date Buried:', ['class' => 'col-sm-3 col-form-label']) !!}
							<div class="col-sm-9">
							{!! Form::date('date_buried', null, ['class' => 'form-control']) !!}
							<span class="text-danger">{{ $errors->first('date_buried') }}</span>
							</div>
						</div>

						<div class="form-group {{$errors->has('burialPlace') ? 'has-error' : '' }} row">			
							{!! Form::label('burialPlace', 'Place Buried:', ['class' => 'col-sm-3 col-form-label']) !!}
							<div class="col-sm-9">
							{!! Form::text('burialPlace', null, ['class' => 'form-control']) !!}
							<span class="text-danger">{{ $errors->first('burialPlace') }}</span>
							</div>
						</div>
					</div>

					<div class="form-group{{$errors->has('baptismDate') ? ' has-error' : '' }} row">			
						{!! Form::label('baptismDate', 'Baptism Date:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::date('baptismDate', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('baptismDate') }}</span>
						</div>
					</div>
					
					{{--
					<div class="form-group{{$errors->has('baptismParish') ? ' has-error' : '' }} row">
						{!! Form::label('baptismParish', 'Baptism Parish:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::text('baptismParish', null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('baptismParish') }}</span>
						</div>
					</div>
					--}}

					<div class="form-group row{{$errors->has('origin_parish') ? ' has-error' : '' }} row">
						{!! Form::label('baptismParish', 'Baptism Parish:', ['class' => 'col-sm-3 col-form-label']) !!}
						<div class="col-sm-7 ui-widget">
						{!! Form::text('baptismParish', Request::get('baptismParish'), array('placeholder' => 'Search parish', 'class' => 'form-control typeahead', 'id' => 'baptismParish', 'name' => 'baptismParish', 'autocomplete' => 'off')) !!}
						<span class="text-danger">{{ $errors->first('baptismParish') }}</span>
						</div>
						<div class="col-sm-2">
	                    <span id="loader_baptism_parish"><i class="fa fa-repeat fa-1x fa-spin"></i></span>
	                  	</div>					
					</div>

					<div class="form-group row{{$errors->has('origin_cell') ? ' has-error' : '' }} row">
						{!! Form::label('origin_cell', 'Origin cell:', ['class' => 'col-sm-3 col-form-label']) !!}
						<div class="col-sm-7 ui-widget">
						{!! Form::text('origin_cell', Request::get('origin_cell'), array('placeholder' => 'Search cell', 'class' => 'form-control typeahead', 'id' => 'origin_cell', 'name' => 'origin_cell', 'autocomplete' => 'off')) !!}
						<span class="text-danger">{{ $errors->first('origin_cell') }}</span>
						</div>
						<div class="col-sm-2">
	                    <span id="loader_origin_cell"><i class="fa fa-repeat fa-1x fa-spin"></i></span>
	                  	</div>					
					</div>

					<div class="form-group row{{$errors->has('origin_parish') ? ' has-error' : '' }} row">
						{!! Form::label('origin_parish', 'Origin parish:', ['class' => 'col-sm-3 col-form-label']) !!}
						<div class="col-sm-7 ui-widget">
						{!! Form::text('origin_parish', Request::get('origin_parish'), array('placeholder' => 'Search parish', 'class' => 'form-control typeahead', 'id' => 'origin_parish', 'name' => 'origin_parish', 'autocomplete' => 'off')) !!}
						<span class="text-danger">{{ $errors->first('origin_parish') }}</span>
						</div>
						<div class="col-sm-2">
	                    <span id="loader_origin_parish"><i class="fa fa-repeat fa-1x fa-spin"></i></span>
	                  	</div>					
					</div>
					
					{{--
					<div class="form-group{{$errors->has('service_id') ? ' has-error' : '' }} row">			
						{!! Form::label('service_id', 'Service:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('service_id', array('' => 'Choose service') + $services, null, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('service_id') }}</span>
						</div>
					</div>						
					--}}

					<div class="form-group{{$errors->has('category_id') ? ' has-error' : '' }} row">			
						{!! Form::label('category_id', 'Category (Icyiciro ubu abarizwamo):', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('category_id[]', array('' => 'Choose category (Press Control to select multiple)') + $categories, null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
						<span class="text-danger">{{ $errors->first('category_id') }}</span>
						</div>
					</div>

					<div class="form-group{{$errors->has('task_id') ? ' has-error' : '' }} row">			
						{!! Form::label('task_id', 'Task (Akora iki mu itorero ku Kinamba):', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('task_id[]', array('' => 'Choose task (Press Control to select multiple)') + $tasks, null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
						<span class="text-danger">{{ $errors->first('task_id') }}</span>
						</div>
					</div>										

					<div class="form-group{{$errors->has('commission_id') ? ' has-error' : '' }} row">
						{!! Form::label('commission_id', 'Commission:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('commission_id[]', array('' => 'Choose commission (Press Control to select multiple)') + $commissions, null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
						<span class="text-danger">{{ $errors->first('commission_id') }}</span>
						</div>
					</div>
					
					{{--
					<div class="form-group{{$errors->has('duty_id') ? ' has-error' : '' }} row">			
						{!! Form::label('duty_id', 'Duty:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('duty_id', array('' => 'Choose duty') + $duties, 1, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('duty_id') }}</span>
						</div>
					</div>
					--}}
					
					<div class="form-group{{$errors->has('choir_id') ? ' has-error' : '' }} row">			
						{!! Form::label('choir_id', 'Choir:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
						<div class="col-sm-9">
						{!! Form::select('choir_id', array('' => 'Choose choir') + $choirs, 1, ['class' => 'form-control']) !!}
						<span class="text-danger">{{ $errors->first('choir_id') }}</span>
						</div>
					</div>					
      			</div>
    		</div>
    	</div>
		
		<div class="form-group{{$errors->has('notes') ? ' has-error' : '' }} row mt-3">			
			{!! Form::label('notes', 'Notes:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
			<div class="col-sm-9">
			{!! Form::textarea('notes', null, ['class' => 'form-control', 'rows' => '3']) !!}
			<span class="text-danger">{{ $errors->first('notes') }}</span>
			</div>
		</div>

		<!--
		<div class="form-group{{$errors->has('fLastName') ? ' has-error' : '' }} row">			
			{!! Form::label('fLastName', 'Father Last Name:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
			<div class="col-sm-9">
			{!! Form::text('fLastName', null, ['class' => 'form-control']) !!}
			<span class="text-danger">{{ $errors->first('fLastName') }}</span>
			</div>
		</div>

		<div class="form-group{{$errors->has('fFirstName') ? ' has-error' : '' }} row">			
			{!! Form::label('fFirstName', 'Father First Name:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
			<div class="col-sm-9">
			{!! Form::text('fFirstName', null, ['class' => 'form-control']) !!}
			<span class="text-danger">{{ $errors->first('fFirstName') }}</span>
			</div>
		</div>

		<div class="form-group{{$errors->has('mLastName') ? ' has-error' : '' }} row">		
			{!! Form::label('mLastName', 'Mother Last Name:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
			<div class="col-sm-9">
			{!! Form::text('mLastName', null, ['class' => 'form-control']) !!}
			<span class="text-danger">{{ $errors->first('mLastName') }}</span>
			</div>
		</div>

		<div class="form-group{{$errors->has('mFirstName') ? ' has-error' : '' }} row">			
			{!! Form::label('mFirstName', 'Mother First Name:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
			<div class="col-sm-9">
			{!! Form::text('mFirstName', null, ['class' => 'form-control']) !!}
			<span class="text-danger">{{ $errors->first('mFirstName') }}</span>
			</div>
		</div>
		-->
		
		<div class="form-group{{$errors->has('confirmed') ? ' has-error' : '' }} text-center">
				Confirmed:									
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
		
		<div class="form-group text-center">
			{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
		</div>
		
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection