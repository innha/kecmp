@extends('layouts.admin')

@section('content')

<!-- dd($chapelles) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-chapelles default_chapelles="{{ $chapelles }}"></vue-chapelles>
      </div>
  </div>
</section>

@endsection

