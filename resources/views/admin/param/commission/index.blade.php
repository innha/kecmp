@extends('layouts.admin')

@section('content')

<!-- dd($commissions) -->

<!-- PEOPLE -->
<section  id="posts">
  <div class="container">
    <div class="row gap-y">
      <div class="col-12">
        <vue-commissions default_commissions="{{ $commissions }}"></vue-commissions>
      </div>
  </div>
</section>

@endsection

