@extends('layouts.admin')

@section('header')

Literacy

@endsection

@section('content')

<div class="container">

<div class="row bg-light">

	<div class="panel mx-auto">

		<div class="panel-heading text-center my-5">
			<h3>New Literacy</h3>
		</div>

		<div class="panel-body">
					
			{!! Form::open(['method' => 'POST', 'action' => 'AdminLiteraciesController@store', 'files' => true]) !!}

				<div class="form-group row">			
					{!! Form::label('registration_id', 'Registration:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('registration_id', array('' => 'Choose registration', '0' => 'New') + $registrations, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('registration_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('period') ? 'has-error' : '' }} row">			
					{!! Form::label('period', 'Period:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('period', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('period') }}</span>
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