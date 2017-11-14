@extends('layouts.admin')

@section('header')

Bridal

@endsection

@section('content')

<div class="container">

<div class="row bg-light">

	<div class="panel mx-auto">

		<div class="panel-heading text-center my-5">
			<h3>New Bridal</h3>
		</div>

		<div class="panel-body">
					
			{!! Form::open(['method' => 'POST', 'action' => 'AdminBridalsController@store', 'files' => true]) !!}

				<div class="form-group row">			
					{!! Form::label('registration_id', 'Registration:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-6 ui-widget">
					{!! Form::text('registration_id', Request::get('registration_id'), array('placeholder' => 'Search registration', 'class' => 'form-control typeahead', 'id' => 'registration_id', 'name' => 'registration_id', 'autocomplete' => 'off')) !!}
					<span class="text-danger">{{ $errors->first('registration_id') }}</span>
					</div>
					<div class="col-2">
                    <span id="loader_registration_id"><i class="fa fa-repeat fa-1x fa-spin"></i></span>
                  	</div>					
				</div>

				<div class="form-group {{$errors->has('bridalName') ? 'has-error' : '' }} row">			
					{!! Form::label('bridalName', 'Bridal:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('bridalName', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('bridalName') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('origin') ? 'has-error' : '' }} row">			
					{!! Form::label('origin', 'Origin:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('origin', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('origin') }}</span>
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