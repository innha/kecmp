@extends('layouts.admin')

@section('content')

<!-- dd($villages) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-villages default_villages="{{ $villages }}"></vue-villages>
      </div>
  </div>
</section>

@endsection

