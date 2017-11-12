@extends('layouts.admin')

@section('header')

Recommendations

@endsection

@section('content')

<!-- ACTIONS -->

<section id="action" class="py-4 mb-4 bg-light">
  <div class="container">            
    <div class="row">
      <div class="col-md-3 ml-3">
        <a href="{{ route('admin.recommendations.create') }}" class="btn btn-primary btn-block">
          <i class="fa fa-plus"></i> Add new
        </a>
      </div>
      <div class="col-md-3 mr-3">
        <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#searchPeopleModal">
          <i class="fa fa-search"></i> Search
        </a>
      </div>
    </div>
  </div>
</section>

{{-- dd($recommendations) --}}

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">  
    <div class="row">
      <div class="col">
          <div class="scrollx">
            <table class="table table-striped table-hover table-sm table-bordered"  id="people-table">
              <thead class="thead-default">
                <tr>
                  <th>ID</th>
                  <th></th>                  
                  <th>REG #</th>
                  <th>DATE ISSUED</th>
                  <th>OWNER</th>
                  <th>HOLDER</th>
                  <th>DESTINATION</th>
                  <th>DATE ARRIVED</th>
                  <th>USER</th>
                  <th>CREATED</th>
                  <th>UPDATED</th>
                </tr>
              </thead>
              <tbody>
              @foreach($recommendations as $recommendation)
                <tr>
                  <td scope="row">{{ $recommendation->id }}</td>
                  <td>
                    <div class="text-center">
                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminRecommendationsController@destroy', $recommendation->id]]) !!}        
                        {!! Form::submit('x', ['class' => 'btn btn-sm btn-danger']) !!}
                    {!! Form::close() !!}
                    </div>
                  </td>                  
                  <td>{{ $recommendation->registration_id }}</td>
                  <td>{{ $recommendation->date_issued }}</td>
                  <td>{{ $recommendation->ownerName }}</td>
                  <td>{{ $recommendation->holderName }}</td>
                  <td>{{ $recommendation->destination }}</td>
                  <td>{{ $recommendation->date_arrived }}</td>
                  <td>{{ $recommendation->user_id }}</td>
                  <td>{{ $recommendation->created_at }}</td>
                  <td>{{ $recommendation->updated_at }}</td>
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
        {{ $recommendations->render("pagination::bootstrap-4") }}
            </div>
          </div>
        <!-- </div> -->
      </div>
    </div>
    </div>
  </div>
</section>

@endsection