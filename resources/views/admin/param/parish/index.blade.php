@extends('layouts.admin')

@section('header')

Parishes

@endsection

@section('content')

{{-- dd($parishes) --}}

<!-- PEOPLE -->
<section  id="posts">
  <div class="container"> 
    <div class="row">
      <div class="col-6">
        <div class="row bg-light">
          <div class="panel mx-auto">
            
            <div class="panel-heading text-center my-2">
              <h3>Add Parish</h3>
            </div>

            <div class="panel-body">
                  
              {!! Form::open(['method' => 'POST', 'action' => 'AdminParishesController@store']) !!}

                <div class="form-group {{$errors->has('diocese_id') ? 'has-error' : '' }} row">      
                  {!! Form::label('diocese_id', 'Diocese:', ['class' => 'col-4 col-form-label']) !!}
                  <div class="col-8">
                  {!! Form::select('diocese_id', array('' => 'Choose diocese') + $dioceses, null, ['class' => 'form-control']) !!}
                  <span class="text-danger">{{ $errors->first('diocese_id') }}</span>
                  </div>
                </div>

                <div class="form-group {{$errors->has('name') ? 'has-error' : '' }} row">      
                  {!! Form::label('name', 'Name:', ['class' => 'col-4 col-form-label']) !!}
                  <div class="col-8">
                  {!! Form::text('name', null, ['class' => 'form-control']) !!}
                  <span class="text-danger">{{ $errors->first('name') }}</span>
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
      <div class="col-6">
          <div>
            <table class="table table-striped table-hover table-sm table-bordered sortable"  id="people-table">
              <thead class="thead-default">
                <tr>
                  <th data-defaultsort="desc">ID</th>
                  <th>DIOCESE</th>
                  <th>NAME</th>                  
                  <!--
                  <th>CREATED</th>
                  <th>UPDATED</th>
                  -->
                  <th></th>
                </tr>
              </thead>
              <tbody>
              @foreach($parishes as $parish)
                <tr>
                  <td scope="row">{{ $parish->id }}</td>
                  <td>{{ $parish->diocese->name }}</td>
                  <td>{{ $parish->name }}</td>                  
                  <!--
                  <td>{{ $parish->created_at }}</td>
                  <td>{{ $parish->updated_at }}</td>
                  -->
                  <td>
                    <div class="text-center">
                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminParishesController@destroy', $parish->id]]) !!}        
                        {!! Form::submit('x', ['class' => 'btn btn-sm btn-danger']) !!}
                    {!! Form::close() !!}
                    </div> 
                  </td>
                  <!--
                  <td><a href="details.html" class="btn btn-scondary">
                    <i class="fa fa-angle-double-right"></i> Details
                  </a></td>
                -->
                </tr>
              @endforeach
              </tbody>
            </table>
            <div class="text-center text-sm-right">
				{{ $parishes->render("pagination::bootstrap-4") }}
            </div>
          </div>
        <!-- </div> -->
      </div>
    </div>
    </div>
  </div>
</section>

@endsection