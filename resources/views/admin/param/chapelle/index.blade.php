@extends('layouts.admin')

@section('header')

Chapelles

@endsection

@section('content')

{{-- dd($chapelles) --}}

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row">
      <div class="col-6">
        <div class="row bg-light">
          <div class="panel mx-auto">
            
            <div class="panel-heading text-center my-2">
              <h3>Add Chapelle</h3>
            </div>

            <div class="panel-body">
                  
              {!! Form::open(['method' => 'POST', 'action' => 'AdminChapellesController@store']) !!}

                <div class="form-group {{$errors->has('parish_id') ? 'has-error' : '' }} row">      
                  {!! Form::label('parish_id', 'Parish:', ['class' => 'col-4 col-form-label']) !!}
                  <div class="col-8">
                  {!! Form::select('parish_id', array('' => 'Choose parish') + $parishes, null, ['class' => 'form-control']) !!}
                  <span class="text-danger">{{ $errors->first('parish_id') }}</span>
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
            <table class="table table-striped table-hover table-sm table-bordered"  id="people-table">
              <thead class="thead-default">
                <tr>
                  <th>ID</th>
                  <th>NAME</th>
                  <th>PARISH</th>
                  <!--
                  <th>CREATED</th>
                  <th>UPDATED</th>
                  -->
                  <th></th>
                </tr>
              </thead>
              <tbody>
              @foreach($chapelles as $chapelle)
                <tr>
                  <td scope="row">{{ $chapelle->id }}</td>
                  <td>{{ $chapelle->name }}</td>
                  <td>{{ $chapelle->parish->name }}</td>
                  <!--
                  <td>{{ $chapelle->created_at }}</td>
                  <td>{{ $chapelle->updated_at }}</td>
                  -->
                  <td>
                    <div class="text-center">
                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminChapellesController@destroy', $chapelle->id]]) !!}        
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
				{{ $chapelles->render("pagination::bootstrap-4") }}
            </div>
          </div>
        <!-- </div> -->
      </div>
    </div>
    </div>
  </div>
</section>

@endsection