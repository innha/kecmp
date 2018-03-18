@extends('layouts.admin')

@section('content')

<!-- dd($dioceses) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-dioceses default_dioceses="{{ $dioceses }}"></vue-dioceses>
      </div>
  </div>
</section>

@endsection

