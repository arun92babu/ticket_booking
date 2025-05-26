@extends('admin.layouts.app')
@section('title', 'User')
@section('content')
  <div class="row">
        
    @section('content')
    <div class="row">
      <div class="col-6 card">
        <h5><a class="nav-link" href="{{ route('admin.users.index') }}">Back</a></h5>
      </div>
      
    </div>
    <h5>View Posts</h5>

    <div class="row">
        @foreach($posts as $post)
       <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->content }}</p>
            <h5>Comments ({{ $post->comments->count() }})</h5>
            @foreach($post->comments as $comment)
                <div class="mb-3">
                    <strong>{{ $comment->author_name }}</strong>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    <p>{{ $comment->content }}</p>
                </div>
            @endforeach
            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}">
              @csrf
              @method('DELETE')
                <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
            </form>
        </div>
    </div>

    @endforeach
    
  </div>
@endsection
  </div>
@endsection
