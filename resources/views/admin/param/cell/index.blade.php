@extends('layouts.admin')

@section('content')

<!-- dd($cells) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-cells default_cells="{{ $cells }}"></vue-cells>
      </div>
  </div>
</section>

@endsection

