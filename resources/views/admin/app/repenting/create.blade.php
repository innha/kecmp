@extends('layouts.admin')

@section('header')

Repenting

@endsection

@section('content')

<div class="container">

<div class="row bg-light">

	<div class="panel mx-auto">

		<div class="panel-heading text-center my-5">
			<h3>New Repenting</h3>
		</div>

		<div class="panel-body">
					
			{!! Form::open(['method' => 'POST', 'action' => 'AdminRepentingsController@store', 'files' => true]) !!}

				<div class="form-group row">			
					{!! Form::label('registration_id', 'Registration:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('registration_id', array('' => 'Choose registration', '0' => 'New') + $registrations, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('registration_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('authRegNum') ? 'has-error' : '' }} row">			
					{!! Form::label('authRegNum', 'Approved By:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('authRegNum', array('' => 'Choose reg #') + $regNums, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('authRegNum') }}</span>
					</div>
				</div>				

				<div class="form-group {{$errors->has('date_returned') ? 'has-error' : '' }} row">			
					{!! Form::label('date_returned', 'Date Returned:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::date('date_returned', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('date_returned') }}</span>
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