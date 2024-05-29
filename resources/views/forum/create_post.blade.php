@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content">
            <div class="col-md-8">
                <h1>Create New Post</h1>
                <form action="{{ route('forum.storePost', $subject) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="content">Name</label>
                        <input class="form-control" id="name" name="name" required>
                        <label for="content">Content</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Reply to a post</label>
                        <select class="form-control" id="parent_id" name="parent_id">
                            <option value="">Select a post to reply</option>
                            @foreach($subject->posts as $post)
                                <option value="{{ $post->id }}" {{ isset($reply_post_id) && $post->id == $reply_post_id ? 'selected disabled' : '' }}>{{ $post->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="reply_post_id" value="{{ $reply_post_id ?? '' }}">
                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
