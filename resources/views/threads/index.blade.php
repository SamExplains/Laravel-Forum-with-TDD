@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card-header">Forum Threads</div>
        @foreach($threads as $thread)
            <div class="card mb-4">

              <div class="card-body">
                  <article>
                    <h4>
                      <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                     <a class="float-right d-inline-block" style="font-size: .8rem" href="{{ $thread->path() }}">{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</a>
                    </h4>
                    <div class="body">
                      {{ $thread->body }}
                    </div>

                    <hr>

                  </article>
              </div>
            </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
