@extends('layouts.admin')

@section('content')

<!-- dd($degrees) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-degrees default_degrees="{{ $degrees }}"></vue-degrees>
      </div>
  </div>
</section>

@endsection

