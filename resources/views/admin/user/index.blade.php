@extends('layouts.admin')

@section('header')

Users

@endsection

@section('content')

<!-- ACTIONS -->
<section id="action" class="py-4 mb-4 bg-light">
  <div class="container">            
    <div class="row">
      <div class="col-md-3 ml-3">
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-block">
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

{{-- dd($users) --}}

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
                  <th>PHOTO</th>
                  <th>ROLE</th>
                  <th>PRIVILEGE</th>
                  <th>ACTIVE</th>
                  <th>NAME</th>
                  <th>EMAIL</th>
                  <th>PHONE</th>
                  <!-- <th>PASSWORD</th> -->
                  <th>PROVINCE</th>
                  <th>DISTRICT</th>
                  <th>SECTOR</th>
                  <th>CELL</th>
                  <th>VILLAGE</th>
                  <th>DIOCESE</th>
                  <th>PARISH</th>
                  <th>CHAPELLE</th>
                  <th>ZONE</th>
                  <th>CREATED</th>
                  <th>UPDATED</th>
                </tr>
              </thead>
              <tbody>
              @foreach($users as $user)
                <tr>
                  <td scope="row">{{ $user->id }}</td>
                  <td>
                    <div class="text-center">
                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]]) !!}        
                        {!! Form::submit('x', ['class' => 'btn btn-sm btn-danger']) !!}
                    {!! Form::close() !!}
                    </div>
                  </td>                  
                  <td><img height="70" width="125" src="{{ $user->photo ? $user->photo->file : 'http://placehold.it/400X400'}}" alt="" /></td>
                  <td>{{ $user->role->name }}</td>
                  <td>{{ $user->privilege->name }}</td>
                  <td>{{ $user->is_active == 1 ? 'Active' : 'Inactive' }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->phone }}</td>
                  <!-- <td>{{ $user->password }}</td> -->
                  <td>{{ $user->province->name }}</td>
                  <td>{{ $user->district->name }}</td>
                  <td>{{ $user->sector->name }}</td>
                  <td>{{ $user->cell->name }}</td>
                  <td>{{ $user->village->name }}</td>
                  <td>{{ $user->diocese->name }}</td>
                  <td>{{ $user->parish->name }}</td>
                  <td>{{ $user->chapelle->name }}</td>
                  <td>{{ $user->zone->name }}</td>
                  <td>{{ $user->created_at->diffForHumans() }}</td>
                  <td>{{ $user->updated_at->diffForHumans() }}</td>
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
				{{ $users->render("pagination::bootstrap-4") }}
            </div>
          </div>
        <!-- </div> -->
      </div>
    </div>
    </div>
  </div>
</section>

@endsection