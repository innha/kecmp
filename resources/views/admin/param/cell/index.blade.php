@extends('layouts.admin')

@section('header')

Cells

@endsection

@section('content')

{{-- dd($cells) --}}

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row">
      <div class="col-6">
        <div class="row bg-light">
          <div class="panel mx-auto">
            
            <div class="panel-heading text-center my-2">
              <h3>Add Cell</h3>
            </div>

            <div class="panel-body">
                  
              {!! Form::open(['method' => 'POST', 'action' => 'AdminCellsController@store']) !!}

                <div class="form-group {{$errors->has('sector_id') ? 'has-error' : '' }} row">      
                  {!! Form::label('sector_id', 'Sector:', ['class' => 'col-4 col-form-label']) !!}
                  <div class="col-8">
                  {!! Form::select('sector_id', array('' => 'Choose sector') + $sectors, null, ['class' => 'form-control']) !!}
                  <span class="text-danger">{{ $errors->first('sector_id') }}</span>
                  </div>
                </div>

                <div class="form-group {{$errors->has('code') ? 'has-error' : '' }} row">      
                  {!! Form::label('code', 'Code:', ['class' => 'col-4 col-form-label']) !!}
                  <div class="col-8">
                  {!! Form::text('code', null, ['class' => 'form-control']) !!}
                  <span class="text-danger">{{ $errors->first('code') }}</span>
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
                  <th>SECTOR</th>
                  <th>CODE</th>
                  <th>NAME</th>
                  <!--
                  <th>CREATED</th>
                  <th>UPDATED</th>
                  -->
                  <th></th>
                </tr>
              </thead>
              <tbody>
              @foreach($cells as $cell)
                <tr>
                  <td scope="row">{{ $cell->id }}</td>
                  <td>{{ $cell->sector->name }}</td>
                  <td>{{ $cell->code }}</td>
                  <td>{{ $cell->name }}</td>
                  <!--
                  <td>{{ $cell->created_at }}</td>
                  <td>{{ $cell->updated_at }}</td>
                  -->
                  <td>
                    <div class="text-center">
                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminCellsController@destroy', $cell->id]]) !!}        
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
				{{ $cells->render("pagination::bootstrap-4") }}
            </div>
          </div>
        <!-- </div> -->
      </div>
    </div>
    </div>
  </div>
</section>

@endsection