@extends('layouts.admin')

@section('header')

Preaching

@endsection

@section('content')

<div class="container">

<div class="row bg-light">

	<div class="panel mx-auto">

		<div class="panel-heading text-center my-5">
			<h3>New Preaching</h3>
		</div>

		<div class="panel-body">
					
			{!! Form::open(['method' => 'POST', 'action' => 'AdminPreachingsController@store', 'files' => true]) !!}

				<div class="form-group row">			
					{!! Form::label('registration_id', 'Registration:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::select('registration_id', array('' => 'Choose registration', '0' => 'New') + $registrations, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('registration_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('topic') ? 'has-error' : '' }} row">			
					{!! Form::label('topic', 'Topic:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('topic', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('topic') }}</span>
					</div>
				</div>

				<div class="form-group row">			
					{!! Form::label('date_preached', 'Date Preached:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::date('date_preached', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('date_preached') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('hasRepented') ? 'has-error' : '' }} row">
					<div class="col-4">
						Has Repented:
					</div>
					<div class="col-8">						
						<div class="form-check form-check-inline">
							<label class="form-check-label">
							{!! Form::radio('hasRepented', true, null, ['class' => 'form-check-input']) !!} Yes</label>
						</div>
						<div class="form-check form-check-inline">
							<label class="form-check-label">
							{!! Form::radio('hasRepented', 0, null, ['class' => 'form-check-input']) !!} No</label>
						</div>
						<span class="text-danger">{{ $errors->first('hasRepented') }}</span>
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