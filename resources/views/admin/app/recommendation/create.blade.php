@extends('layouts.admin')

@section('header')

Recommendation

@endsection

@section('content')

<div class="container">

<div class="row bg-light">

	<div class="panel mx-auto">

		<div class="panel-heading text-center my-5">
			<h3>New Recommendation</h3>
		</div>

		<div class="panel-body">
					
			{!! Form::open(['method' => 'POST', 'action' => 'AdminRecommendationsController@store', 'files' => true]) !!}

				<div class="form-group row">			
					{!! Form::label('registration_id', 'Registration:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('registration_id', array('' => 'Choose ownerName', '0' => 'New') + $registrations, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('registration_id') }}</span>
					</div>
				</div>

				<div class="form-group row">			
					{!! Form::label('date_issued', 'Date Issued:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::date('date_issued', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('date_issued') }}</span>
					</div>
				</div>

				<div class="form-group row">			
					{!! Form::label('date_arrived', 'Date Arrived:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::date('date_arrived', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('date_arrived') }}</span>
					</div>
				</div>				

				<div class="form-group {{$errors->has('ownerName') ? 'has-error' : '' }} row">			
					{!! Form::label('ownerName', 'Owner:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('ownerName', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('ownerName') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('destination') ? 'has-error' : '' }} row">			
					{!! Form::label('destination', 'Destination:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('destination', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('destination') }}</span>
					</div>
				</div>				

				<div class="form-group {{$errors->has('holderName') ? 'has-error' : '' }} row">			
					{!! Form::label('holderName', 'Holder:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('holderName', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('holderName') }}</span>
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