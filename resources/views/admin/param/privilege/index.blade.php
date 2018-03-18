@extends('layouts.admin')

@section('content')

<!-- dd($privileges) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-privileges default_privileges="{{ $privileges }}"></vue-privileges>
      </div>
  </div>
</section>

@endsection

