@extends('layouts.admin')

@section('header')

Burial

@endsection

@section('content')

<div class="container">

<div class="row bg-light">

	<div class="panel mx-auto">

		<div class="panel-heading text-center my-5">
			<h3>New Burial</h3>
		</div>

		<div class="panel-body">
					
			{!! Form::open(['method' => 'POST', 'action' => 'AdminBurialsController@store', 'files' => true]) !!}

				<div class="form-group row">			
					{!! Form::label('registration_id', 'Registration:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('registration_id', array('' => 'Choose registration', '0' => 'New') + $registrations, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('registration_id') }}</span>
					</div>
				</div>

				<div class="form-group row">			
					{!! Form::label('date_died', 'Date Died:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::date('date_died', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('date_died') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('burialPlace') ? 'has-error' : '' }} row">			
					{!! Form::label('burialPlace', 'Place Buried:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('burialPlace', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('burialPlace') }}</span>
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