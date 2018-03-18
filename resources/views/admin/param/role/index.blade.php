@extends('layouts.admin')

@section('content')

<!-- dd($roles) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-roles default_roles="{{ $roles }}"></vue-roles>
      </div>
  </div>
</section>

@endsection
