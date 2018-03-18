@extends('layouts.admin')

@section('content')

<!-- dd($duties) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-duties default_duties="{{ $duties }}"></vue-duties>
      </div>
  </div>
</section>

@endsection

