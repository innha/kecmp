@extends('layouts.admin')

@section('content')

<!-- dd($provinces) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-provinces default_provinces="{{ $provinces }}"></vue-provinces>
      </div>
  </div>
</section>

@endsection
