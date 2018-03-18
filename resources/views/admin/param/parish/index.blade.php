@extends('layouts.admin')

@section('content')

<!-- dd($parishes) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-parishes default_parishes="{{ $parishes }}"></vue-parishes>
      </div>
  </div>
</section>

@endsection

