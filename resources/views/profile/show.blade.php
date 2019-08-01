@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-8 mx-auto">
        <h4>{{ $profileUser->name }} <small>since {{ $profileUser->created_at->diffForHumans() }}</small></h4>
      </div>
      @foreach ($threads as $thread)
        <div class="col-8 mx-auto">
          <h4>{{ $thread->title }} <small>since {{ $thread->created_at->diffForHumans() }}</small></h4>
          <p>{{ $thread->body }}</p>
        </div>
      @endforeach

      <div class="col-8 mx-auto">
        {{ $threads->links() }}
      </div>

    </div>
  </div>

@endsection
