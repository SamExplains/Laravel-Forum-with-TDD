@extends('layouts.app')
@section('content')
    <div class="container">
        <h3>{{ $profileUser->name }}</h3>

        @foreach($threads as $thread)
            <div class="mb-3">
                <h5>{{ $thread->title }}</h5>
                <p>{{ $thread->body }}</p>
                <small>{{ $thread->created_at->diffForHumans() }}</small>
            </div>
        @endforeach

        {{ $threads->links() }}

    </div>
@endsection
