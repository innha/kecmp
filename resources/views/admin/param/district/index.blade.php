@extends('layouts.admin')

@section('content')

<!-- dd($districts) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-districts default_districts="{{ $districts }}"></vue-districts>
      </div>
  </div>
</section>

@endsection

