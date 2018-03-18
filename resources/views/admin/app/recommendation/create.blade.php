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
					<div class="col-6 ui-widget">
					{!! Form::text('registration_id', Request::get('registration_id'), array('placeholder' => 'Search registration', 'class' => 'form-control typeahead', 'id' => 'registration_id', 'name' => 'registration_id', 'autocomplete' => 'off')) !!}
					<span class="text-danger">{{ $errors->first('registration_id') }}</span>
					</div>
					<div class="col-2">
                    <span id="loader_registration_id"><i class="fa fa-repeat fa-1x fa-spin"></i></span>
                  	</div>					
				</div>
								
				<!--
				<div class="form-group {{$errors->has('type') ? 'has-error' : '' }} row">
					<div class="col-4">
						Type:
					</div>
					<div class="col-8">						
						<div class="form-check form-check-inline">
							<label class="form-check-label">
							{!! Form::radio('type', 'in', null, ['class' => 'form-check-input']) !!} In</label>
						</div>
						<div class="form-check form-check-inline">
							<label class="form-check-label">
							{!! Form::radio('type', 'out', null, ['class' => 'form-check-input']) !!} Out</label>
						</div>
						<span class="text-danger">{{ $errors->first('type') }}</span>
					</div>
				</div>
				
				<div class="form-group {{$errors->has('origin') ? 'has-error' : '' }} row">			
					{!! Form::label('origin', 'Origin:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('origin', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('origin') }}</span>
					</div>
				</div>
				-->

				<div class="form-group row{{$errors->has('origin_parish') ? ' has-error' : '' }} row">
					{!! Form::label('origin_parish', 'Origin parish:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-6 ui-widget">
					{!! Form::text('origin_parish', Request::get('origin_parish'), array('placeholder' => 'Search parish', 'class' => 'form-control typeahead', 'id' => 'origin_parish', 'name' => 'origin_parish', 'autocomplete' => 'off')) !!}
					<span class="text-danger">{{ $errors->first('origin_parish') }}</span>
					</div>
					<div class="col-2">
                    <span id="loader_origin_parish"><i class="fa fa-repeat fa-1x fa-spin"></i></span>
                  	</div>					
				</div>

				<div class="form-group row">			
					{!! Form::label('date_issued', 'Date Issued:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::date('date_issued', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('date_issued') }}</span>
					</div>
				</div>
				
				<!--
				<div class="form-group {{$errors->has('destination') ? 'has-error' : '' }} row">			
					{!! Form::label('destination', 'Destination:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('destination', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('destination') }}</span>
					</div>
				</div>
				-->

				<div class="form-group row{{$errors->has('destination_parish') ? ' has-error' : '' }} row">
					{!! Form::label('destination_parish', 'Destination Parish:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-6 ui-widget">
					{!! Form::text('destination_parish', Request::get('destination_parish'), array('placeholder' => 'Search parish', 'class' => 'form-control typeahead', 'id' => 'destination_parish', 'name' => 'destination_parish', 'autocomplete' => 'off')) !!}
					<span class="text-danger">{{ $errors->first('destination_parish') }}</span>
					</div>
					<div class="col-2">
                    <span id="loader_destination_parish"><i class="fa fa-repeat fa-1x fa-spin"></i></span>
                  	</div>					
				</div>

				<div class="form-group row">			
					{!! Form::label('date_arrived', 'Date Arrived:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::date('date_arrived', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('date_arrived') }}</span>
					</div>
				</div>								
				<!--
				<div class="form-group {{$errors->has('holderName') ? 'has-error' : '' }} row">			
					{!! Form::label('holderName', 'Holder:', ['class' => 'col-4 col-form-label']) !!}
					<div class="col-8">
					{!! Form::text('holderName', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('holderName') }}</span>
					</div>
				</div>				
				-->
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