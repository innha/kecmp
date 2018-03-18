@extends('layouts.admin')

@section('content')

<!-- dd($categories) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-categories default_categories="{{ $categories }}"></vue-categories>
      </div>
  </div>
</section>

@endsection

