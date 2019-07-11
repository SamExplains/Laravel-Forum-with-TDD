@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <a href="#">{{ $thread->creator->name }} posted: </a>
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
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 offset-md-2">
        @foreach($thread->replies as $reply)
          @include('partials.reply')
        @endforeach
      </div>
    </div>

    @if (auth()->check())
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <form method="POST" action="{{ $thread->path() . '/replies' }}">
          <div class="form-group">
            {{ csrf_field() }}
            <label for="body">Body</label>
            <textarea class="form-control" name="body" id="body" rows="5" placeholder="Have something to say?"></textarea>
          </div>

          <button type="submit" class="btn btn-primary">Post</button>
        </form>
      </div>
    </div>
    @else
      <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to add to the discussion</p>
    @endif

  </div>
@endsection




