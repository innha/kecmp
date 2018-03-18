@extends('layouts.admin')

@section('content')

<!-- dd($sectors) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-sectors default_sectors="{{ $sectors }}"></vue-sectors>
      </div>
  </div>
</section>

@endsection

