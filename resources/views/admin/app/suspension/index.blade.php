@extends('layouts.admin')

@section('header')

Suspensions

@endsection

@section('content')

<!-- ACTIONS -->
<section id="action" class="py-4 mb-4 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-3 ml-3">
        <a href="{{ route('admin.suspensions.create') }}" class="btn btn-primary btn-block">
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

{{-- dd($suspensions) --}}

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
                  <th>REASON</th>
                  <th>REG #</th>
                  <th>USER</th>
                  <th>CREATED</th>
                  <th>UPDATED</th>
                  <th colspan="2">Ops</th>
                </tr>
              </thead>
              <tbody>
              @foreach($suspensions as $suspension)
                <tr>
                  <td scope="row">{{ $suspension->id }}</td>
                  <td>{{ $suspension->reason }}</td>
                  <td>{{ $suspension->authRegNum }}</td>
                  <td>{{ $suspension->user_id }}</td>
                  <td>{{ $suspension->created_at }}</td>
                  <td>{{ $suspension->updated_at }}</td>
                  <td colspan="2"><a href="#">Edit</a>&nbsp;<a href="#">Delete</a></td>
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
					   {{ $suspensions->render("pagination::bootstrap-4") }}
            </div>
          </div>
        <!-- </div> -->
      </div>
    </div>
    </div>
  </div>
</section>

@endsection