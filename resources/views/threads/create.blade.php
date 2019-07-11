@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Create a New Thread</div>

          <div class="card-body">
            <form method="post" action="{{ route('threads.store') }}">

              {{ csrf_field() }}

              <div class="form-group">
                <label for="">Title</label>
                <input type="text"
                       class="form-control" name="title" id="title" aria-describedby="helpId" placeholder="A title">
                <small id="helpId" class="form-text text-muted">Help text</small>
              </div>

              <div class="form-group">
                <label for="body">Body</label>
                <textarea class="form-control" name="body" id="body" rows="8" placeholder="A description"></textarea>
              </div>

              <button type="submit" class="btn btn-primary">Publish</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
