@extends('layouts.admin')

@section('content')

<!-- dd($zones) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-zones default_zones="{{ $zones }}"></vue-zones>
      </div>
  </div>
</section>

@endsection

