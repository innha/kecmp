@extends('layouts.admin')

@section('content')

<!-- dd($tasks) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-tasks default_tasks="{{ $tasks }}"></vue-tasks>
      </div>
  </div>
</section>

@endsection

