@extends('layouts.admin')

@section('header')

Villages

@endsection

@section('content')

{{-- dd($villages) --}}

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">  
    <div class="row">
      <div class="col-6">
        <div class="row bg-light">
          <div class="panel mx-auto">
            
            <div class="panel-heading text-center my-2">
              <h3>Add Village</h3>
            </div>

            <div class="panel-body">
                  
              {!! Form::open(['method' => 'POST', 'action' => 'AdminVillagesController@store']) !!}

                <div class="form-group {{$errors->has('cell_id') ? 'has-error' : '' }} row">      
                  {!! Form::label('cell_id', 'Cell:', ['class' => 'col-4 col-form-label']) !!}
                  <div class="col-8">
                  {!! Form::select('cell_id', array('' => 'Choose cell') + $cells, null, ['class' => 'form-control']) !!}
                  <span class="text-danger">{{ $errors->first('cell_id') }}</span>
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
                  <th>CODE</th>
                  <th>NAME</th>
                  <th>CELL</th>
                  <!--
                  <th>CREATED</th>
                  <th>UPDATED</th>
                  -->
                  <th></th>
                </tr>
              </thead>
              <tbody>
              @foreach($villages as $village)
                <tr>
                  <td scope="row">{{ $village->id }}</td>
                  <td>{{ $village->code }}</td>
                  <td>{{ $village->name }}</td>
                  <td>{{ $village->cell->name }}</td>
                  <!--
                  <td>{{ $village->created_at }}</td>
                  <td>{{ $village->updated_at }}</td>
                  -->
                  <td>
                    <div class="text-center">
                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminVillagesController@destroy', $village->id]]) !!}        
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
				{{ $villages->render("pagination::bootstrap-4") }}
            </div>
          </div>
        <!-- </div> -->
      </div>
    </div>
    </div>
  </div>
</section>

@endsection