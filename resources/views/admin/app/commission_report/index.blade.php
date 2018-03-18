@extends('layouts.admin')

@section('header')

Commssion reports

@endsection

@section('content')

<!-- ACTIONS -->

<section id="action" class="py-4 mb-4 bg-light">
  <div class="container">            
    <div class="row">
      <div class="col-md-3 ml-3">
        <a href="{{ route('admin.commission_reports.create') }}" class="btn btn-primary btn-block">
          <i class="fa fa-plus"></i> Add new
        </a>
      </div>
      <div class="col-md-8 mr-1">
        {{--
        <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#searchPeopleModal">
          <i class="fa fa-search"></i> Search registration
        </a>
        --}}
        {{--
        <form action="/admin/registrations/search" method="POST" role="search">
          {{ csrf_field() }}
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search by last/first name, email, phone, reg/id number">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-warning">
                <span class="fa fa-search"></span>
              </button>
            </span>
          </div>
        </form>
        --}}
      </div>
    </div>
  </div>
</section>

{{-- dd($commission_reports) --}}

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">  
    <div class="row">
      <div class="col">
          <div class="scrollx">
            <table class="table table-striped table-hover table-sm table-bordered sortable"  id="people-table">
              <thead class="thead-default">
                <tr>
                  <th data-defaultsort="desc">ID</th>
                  <th></th>              
                  <th>COMMISSION</th>
                  <th>REPORT</th>
                  <th>DATE</th>
                  <th>COMMENT</th>
                  <th>USER</th>
                  <th>CREATED</th>
                  <th>UPDATED</th>
                </tr>
              </thead>
              <tbody>
              @foreach($commission_reports as $commission_report)
                <tr>
                  <td scope="row">{{ $commission_report->id }}</td>
                  <td>
                    <div class="text-center">
                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminCommissionReportsController@destroy', $commission_report->id]]) !!}        
                        {!! Form::submit('x', ['class' => 'btn btn-sm btn-danger']) !!}
                    {!! Form::close() !!}
                    </div>
                  </td>
                  <td>{{ $commission_report->commission->name }}</td>
                  <td><a href="{{ asset("commission_reports/$commission_report->report") }}">{{ $commission_report->report }}</a></td>
                  <td>{{ $commission_report->report_date }}</td>
                  <td>{{ $commission_report->comment }}</td>
                  <td>{{ $commission_report->user_id }}</td>
                  <td>{{ $commission_report->created_at }}</td>
                  <td>{{ $commission_report->updated_at }}</td>
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
        {{ $commission_reports->render("pagination::bootstrap-4") }}
            </div>
          </div>
        <!-- </div> -->
      </div>
    </div>
    </div>
  </div>
</section>

@endsection