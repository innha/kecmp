@extends('layouts.admin')

@section('header')

Burials

@endsection

@section('content')

<!-- ACTIONS -->
<section id="action" class="py-4 mb-4 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-3 ml-3">
        <a href="{{ route('admin.burials.create') }}" class="btn btn-primary btn-block">
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

{{-- dd($burials) --}}

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
                  <th>REG ID</th>
                  <th>DATE DIED</th>
                  <th>PLACE BURIED</th>
                  <th>USER</th>
                  <th>CREATED</th>
                  <th>UPDATED</th>
                  <th colspan="2">Ops</th>
                </tr>
              </thead>
              <tbody>
              @foreach($burials as $burial)
                <tr>
                  <td scope="row">{{ $burial->id }}</td>
                  <td>{{ $burial->registration_id }}</td>
                  <td>{{ $burial->date_died }}</td>
                  <td>{{ $burial->burialPlace }}</td>
                  <td>{{ $burial->user_id }}</td>
                  <td>{{ $burial->created_at }}</td>
                  <td>{{ $burial->updated_at }}</td>
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
				{{ $burials->render("pagination::bootstrap-4") }}
            </div>
          </div>
        <!-- </div> -->
      </div>
    </div>
    </div>
  </div>
</section>

@endsection