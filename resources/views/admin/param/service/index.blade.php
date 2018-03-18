@extends('layouts.admin')

@section('content')

<!-- dd($services) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-services default_services="{{ $services }}"></vue-services>
      </div>
  </div>
</section>

@endsection

