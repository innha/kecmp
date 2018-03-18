@extends('layouts.admin')

@section('content')

<!-- dd($statuses) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-statuses default_statuses="{{ $statuses }}"></vue-statuses>
      </div>
  </div>
</section>

@endsection

