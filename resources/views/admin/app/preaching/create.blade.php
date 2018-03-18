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
				<!--
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
				-->
				<div class="form-group {{$errors->has('visitor_names') ? 'has-error' : '' }} row">			
					{!! Form::label('visitor_names', 'Visitor\'s names:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('visitor_names', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('visitor_names') }}</span>
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
				<!--
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
				-->
				<div class="form-group {{$errors->has('num_repented') ? 'has-error' : '' }} row">			
					{!! Form::label('num_repented', 'Number repented:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('num_repented', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('num_repented') }}</span>
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