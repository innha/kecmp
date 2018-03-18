@extends('layouts.admin')

@section('content')

<!-- dd($choirs) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-choirs default_choirs="{{ $choirs }}"></vue-choirs>
      </div>
  </div>
</section>

@endsection

