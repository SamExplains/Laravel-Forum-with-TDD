@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <a href="{{ '/profiles/' . $thread->creator->name }}">{{ $thread->creator->name }} posted: </a>
            {{ $thread->title }}
          </div>

          <div class="card-body">
              <article>
                <div class="body">
                  {{ $thread->body }}
                </div>
              </article>
          </div>
        </div>

        @foreach($thread->replies as $reply)
          @include('partials.reply')
        @endforeach

        {{ $replies->links() }}

        @if (auth()->check())
          <form method="POST" action="{{ $thread->path() . '/replies' }}">
            <div class="form-group mt-3">
              {{ csrf_field() }}
              <textarea class="form-control" name="body" id="body" rows="5" placeholder="Have something to say?"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Post</button>
          </form>
        @else
          <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to add to the discussion</p>
        @endif

      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-body">
            <p class="card-text">This thread was publshed {{ $thread->created_at->diffForHumans() }} by
              <a href="#">{{ $thread->creator->name }}</a>, and currently has {{ $thread->replies_count }} {{ str_plural('comment', $thread->replies_count) }}.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection




