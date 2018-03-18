@extends('layouts.admin')

@section('header')

Dashboard

{{-- dd($dashboard) --}}

@endsection

@section('content')

<!-- POSTS -->
<section  id="posts">
  <div class="container">
    <!-- row 1 -->
    <div class="row my-2">
      <div class="col-sm-2">
        <div class="card text-center bg-primary text-white mb-3">
          <div class="card-body">
            <h4>Registered</h4>
            <h2 class="display-4">
              <i class="fa fa-male"></i> {{ $dashboard['registrations'] }}
            </h2>
            <a href="{{ route('admin.registrations.index') }}" class="btn btn-outline-light btn-sm">View</a>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="card text-center text-white mb-3" style="background-color: #99738e;">
          <div class="card-body">
            <h4>Kids</h4>
            <h2 class="display-4">
              <i class="fa fa-bell"></i> {{ $dashboard['kids'] }}
            </h2>
            <a href="{{ route('admin.kids.index') }}" class="btn btn-outline-light btn-sm">View</a>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="card text-center text-white mb-3" style="background-color: #2f2fa2;">
          <div class="card-body">
            <h4>Preaching</h4>
            <h2 class="display-4">
              <i class="fa fa-bullhorn"></i> {{ $dashboard['preachings'] }}
            </h2>
            <a href="{{ route('admin.preachings.index') }}" class="btn btn-outline-light btn-sm">View</a>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="card text-center text-white mb-3" style="background-color: #afd275;">
          <div class="card-body">
            <h4>Literacy</h4>
            <h2 class="display-4">
              <i class="fa fa-pencil-square-o"></i> {{ $dashboard['literacies'] }}
            </h2>
            <a href="{{ route('admin.literacies.index') }}" class="btn btn-outline-light btn-sm">View</a>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="card text-center text-white mb-3" style="background-color: #f172a1;">
          <div class="card-body">
            <h4>Bridals</h4>
            <h2 class="display-4">
              <i class="fa fa-heartbeat"></i> {{ $dashboard['bridals'] }}
            </h2>
            <a href="{{ route('admin.bridals.index') }}" class="btn btn-outline-light btn-sm">View</a>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="card text-center text-white mb-3" style="background-color: #e64398;">
          <div class="card-body">
            <h4>Marriages</h4>
            <h2 class="display-4">
              <i class="fa fa-heart-o"></i> {{ $dashboard['marriages'] }}
            </h2>
            <a href="{{ route('admin.marriages.index') }}" class="btn btn-outline-light btn-sm">View</a>
          </div>
        </div>
      </div>
    </div>
    <!-- end row 1 -->

    <!-- row 2 -->
    <div class="row my-2">
      <div class="col-sm-2">
        <div class="card text-center bg-success text-white mb-3">
          <div class="card-body">
            <h4>Baptised</h4>
            <h2 class="display-4">
              <i class="fa fa-star"></i> {{ $dashboard['baptisms'] }}
            <a href="{{ route('admin.baptisms.index') }}" class="btn btn-outline-light btn-sm">View</a>
          </h2>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="card text-center text-white mb-3" style="background-color: #ff0000;">
          <div class="card-body">
            <h4>Suspended</h4>
            <h2 class="display-4">
              <i class="fa fa-times-circle"></i> {{ $dashboard['suspensions'] }}
            </h2>
            <a href="{{ route('admin.suspensions.index') }}" class="btn btn-outline-light btn-sm">View</a>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="card text-center text-white mb-3" style="background-color: #3b945e;">
          <div class="card-body">
            <h4>Repenting<br /><br /></h4>
            <h2 class="display-4">
              <i class="fa fa-reply"></i> {{ $dashboard['repentings'] }}
            </h2>
            <a href="{{ route('admin.repentings.index') }}" class="btn btn-outline-light btn-sm">View</a>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="card text-center text-white mb-3" style="background-color: #501b1d;">
          <div class="card-body">
            <h4>Recommendations</h4>
            <h2 class="display-4">
              <i class="fa fa-envelope-open"></i> {{ $dashboard['recommendations'] }}
            </h2>
            <a href="{{ route('admin.recommendations.index') }}" class="btn btn-outline-light btn-sm">View</a>
          </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class="card text-center text-white mb-3" style="background-color: #86c232;">
          <div class="card-body">
            <h4>New Believers</h4>
            <h2 class="display-4">
              <i class="fa fa-user-plus"></i> {{ $dashboard['teachings'] }}
            </h2>
            <a href="{{ route('admin.teachings.index') }}" class="btn btn-outline-light btn-sm">View</a>
          </div>
        </div>
      </div>
    <div class="col-sm-2">
      <div class="card text-center text-white mb-3" style="background-color: #64485c;">
        <div class="card-body">
          <h4>From Elsewhere</h4>
          <h2 class="display-4">
            <i class="fa fa-arrow-left"></i> {{ $dashboard['receptions'] }}
          </h2>
          <a href="{{ route('admin.receptions.index') }}" class="btn btn-outline-light btn-sm">View</a>
        </div>
      </div>
    </div>
    </div>
    <!-- end row 2 -->

    <!-- row 3 -->
    <div class="row my-2">
      <div class="col-sm-6">
        <div class="card text-center text-white mb-3" style="background-color: #daad86;">
          <div class="card-body">
            <h4>Choirs</h4>
            <h2 class="display-4">
              <i class="fa fa-music"></i> {{ $dashboard['choirs'] }}
            </h2>
            <a href="{{ route('admin.choirs.index') }}" class="btn btn-outline-light btn-sm">View</a>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card text-center text-white mb-3" style="background-color: #000000;">
          <div class="card-body">
            <h4>Burials</h4>
            <h2 class="display-4">
              <i class="fa fa-ambulance"></i> {{ $dashboard['burials'] }}
            </h2>
            <a href="{{ route('admin.burials.index') }}" class="btn btn-outline-light btn-sm">View</a>
          </div>
        </div>
      </div>
  </div>
    <!-- end row 3 -->
  </div>
</section>

@endsection