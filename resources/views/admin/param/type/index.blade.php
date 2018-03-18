@extends('layouts.admin')

@section('content')

<!-- dd($types) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-types default_types="{{ $types }}"></vue-types>
      </div>
  </div>
</section>

@endsection

