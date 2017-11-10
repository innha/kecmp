@extends('layouts.admin')

@section('header')

Registration

@endsection

@section('content')

<!-- ACTIONS -->
<section id="action" class="py-4 mb-4 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-3 ml-3">
        <a href="{{ route('admin.registrations.create') }}" class="btn btn-primary btn-block">
          <i class="fa fa-plus"></i> New registration
        </a>
      </div>
      <div class="col-md-3 mr-3">
        <a href="#" class="btn btn-warning btn-block" data-toggle="modal" data-target="#searchPeopleModal">
          <i class="fa fa-search"></i> Search registration
        </a>
      </div>
    </div>
  </div>
</section>

{{-- dd($registrations) --}}

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
                  <th>TYPE</th>
                  <th>REG #</th>
                  <th>LASTNAME</th>
                  <th>FIRSTNAME</th>
                  <th>FATHER LAST</th>
                  <th>FATHER FIRST</th>
                  <th>MOTHER LAST</th>
                  <th>MOTHER FIRST</th>
                  <th>DOB</th>
                  <th>BIRTHPLACE</th>
                  <th>PHONE 1</th>
                  <th>PHONE 2</th>
                  <th>GENDER</th>
                  <th>ID #</th>
                  <th>EDUCATION</th>
                  <th>SCHOOL</th>
                  <th>MARITAL STATUS</th>
                  <th>EMAIL</th>
                  <th>VILLAGE</th>
                  <th>CELL</th>
                  <th>SECTOR</th>
                  <th>DISTRICT</th>
                  <th>PROVINCE</th>
                  <th>ZONE</th>
                  <th>CHAPELLE</th>
                  <th>PARISH</th>
                  <th>DIOCESE</th>
                  <th>HOUSE OWNER</th>
                  <th>JOB</th>
                  <th>EMPLOYER</th>
                  <th>JOB LOCATION</th>
                  <th>BAPTISM DATE</th>
                  <th>BAPT. PARISH</th>
                  <th>DUTIES</th>
                  <th>CATEGORY</th>
                  <th>SERVICE</th>
                  <th>COMMISSION</th>
                  <th>CHOIR</th>
                  <th>USER</th>
                  <th>STATUS</th>
                  <th>CONFIRMED</th>
                  <th>CREATED</th>
                  <th>UPDATED</th>
                  <th>NOTES</th>                  
                </tr>
              </thead>
              <tbody>
              @foreach($registrations as $registration)
                <tr>              
                  <td scope="row">{{ $registration->id }}</td>
                  <td>
                    <div class="text-center">
                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminRegistrationsController@destroy', $registration->id]]) !!}        
                        {!! Form::submit('x', ['class' => 'btn btn-sm btn-danger']) !!}
                    {!! Form::close() !!}
                    </div>
                  </td>                  
                  <td>{{ $registration->type->name }}</td>
                  <td>{{ $registration->regNumber }}</td>
                  <td>{{ $registration->lastName }}</td>
                  <td>{{ $registration->firstName }}</td>
                  <td>{{ $registration->fLastName }}</td>
                  <td>{{ $registration->fFirstName }}</td>
                  <td>{{ $registration->mLastname }}</td>
                  <td>{{ $registration->mFirstName }}</td>
                  <td>{{ $registration->dob }}</td>
                  <td>{{ $registration->birthPlace }}</td>
                  <td>{{ $registration->phoneOne }}</td>
                  <td>{{ $registration->phoneTwo }}</td>
                  <td>{{ $registration->gender }}</td>
                  <td>{{ $registration->idNumber }}</td>
                  <td>{{ $registration->degree->name }}</td>
                  <td>{{ $registration->school }}</td>
                  <td>{{ $registration->maritalStatus }}</td>
                  <td>{{ $registration->email }}</td>
                  <td>{{ $registration->village->name }}</td>
                  <td>{{ $registration->cell->name }}</td>
                  <td>{{ $registration->sector->name }}</td>
                  <td>{{ $registration->district->name }}</td>
                  <td>{{ $registration->province->name }}</td>
                  <td>{{ $registration->zone->name }}</td>
                  <td>{{ $registration->chapelle->name }}</td>
                  <td>{{ $registration->parish->name }}</td>
                  <td>{{ $registration->diocese->name }}</td>
                  <td>{{ $registration->ownsHouse }}</td>
                  <td>{{ $registration->job }}</td>
                  <td>{{ $registration->employer }}</td>
                  <td>{{ $registration->jobLocation }}</td>
                  <td>{{ $registration->baptismDate }}</td>
                  <td>{{ $registration->baptismParish }}</td>
                  <td>{{ $registration->duty->name }}</td>
                  <td>{{ $registration->category->name }}</td>
                  <td>{{ $registration->service->name }}</td>
                  <td>{{ $registration->commission->name }}</td>
                  <td>{{ $registration->choir->name }}</td>
                  <td>{{ $registration->user_id }}</td>
                  <td>{{ $registration->status->name }}</td>
                  <td>{{ $registration->confirmed }}</td>                  
                  <td>{{ $registration->created_at }}</td>
                  <td>{{ $registration->updated_at }}</td>
                  <td>{{ $registration->notes }}</td>
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
					   {{ $registrations->render("pagination::bootstrap-4") }}
            </div>
          </div>
        <!-- </div> -->
      </div>
    </div>
    </div>
  </div>
</section>

@endsection