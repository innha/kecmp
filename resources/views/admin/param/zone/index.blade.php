@extends('layouts.admin')

@section('header')

Zones

@endsection

@section('content')

{{-- dd($zones) --}}

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">      
    <div class="row">
      <div class="col-6">
        <div class="row bg-light">
          <div class="panel mx-auto">
            
            <div class="panel-heading text-center my-2">
              <h3>Add Zone</h3>
            </div>

            <div class="panel-body">
                  
              {!! Form::open(['method' => 'POST', 'action' => 'AdminZonesController@store']) !!}

                <div class="form-group {{$errors->has('chapelle_id') ? 'has-error' : '' }} row">      
                  {!! Form::label('chapelle_id', 'Zone:', ['class' => 'col-4 col-form-label']) !!}
                  <div class="col-8">
                  {!! Form::select('chapelle_id', array('' => 'Choose chapelle') + $chapelles, null, ['class' => 'form-control']) !!}
                  <span class="text-danger">{{ $errors->first('chapelle_id') }}</span>
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
                  <th>NAME</th>
                  <!--
                  <th>CREATED</th>
                  <th>UPDATED</th>
                  -->
                  <th></th>
                </tr>
              </thead>
              <tbody>
              @foreach($zones as $zone)
                <tr>
                  <td scope="row">{{ $zone->id }}</td>
                  <td>{{ $zone->name }}</td>
                  <!--
                  <td>{{ $zone->created_at }}</td>
                  <td>{{ $zone->updated_at }}</td>
                  -->
                  <td>
                    <div class="text-center">
                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminZonesController@destroy', $zone->id]]) !!}        
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
				{{ $zones->render("pagination::bootstrap-4") }}
            </div>
          </div>
        <!-- </div> -->
      </div>
    </div>
    </div>
  </div>
</section>

@endsection