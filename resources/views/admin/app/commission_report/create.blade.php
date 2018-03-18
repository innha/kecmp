@extends('layouts.admin')

@section('header')

Commission members

@endsection

@section('content')

<div class="container">

<div class="row bg-light">

	<div class="panel mx-auto">

		<div class="panel-heading text-center my-5">
			<h3>New Commission Report</h3>
		</div>

		<div class="panel-body">
					
			{!! Form::open(['method' => 'POST', 'action' => 'AdminCommissionReportsController@store', 'files' => true]) !!}
				
				<div class="form-group{{$errors->has('commission_id') ? ' has-error' : '' }} row">			
					{!! Form::label('commission_id', 'Commission:', ['class' => 'col-sm-3 col-form-label col-form-label-xs']) !!}
					<div class="col-sm-9">
					{!! Form::select('commission_id', array('' => 'Choose commission') + $commissions, null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('commission_id') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('report') ? 'has-error' : '' }} row">			
					{!! Form::label('report', 'Report:', ['class' => 'col-sm-3 col-form-label']) !!}
					<div class="col-sm-9">
					{!! Form::file('report', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('report') }}</span>
					</div>
				</div>

				<div class="form-group row">			
					{!! Form::label('report_date', 'Date:', ['class' => 'col-sm-3 col-form-label']) !!}
					<div class="col-sm-9">
					{!! Form::date('report_date', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('report_date') }}</span>
					</div>
				</div>

				<div class="form-group {{$errors->has('comment') ? 'has-error' : '' }} row">			
					{!! Form::label('comment', 'Comment:', ['class' => 'col-sm-3 col-form-label']) !!}
					<div class="col-sm-9">
					{!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
					<span class="text-danger">{{ $errors->first('comment') }}</span>
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