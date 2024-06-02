@extends('index')

@section('content')
<div class="container">
    <h1>Edit Answer</h1>
    <form action="{{ route('subject.post.updatePost', [$subject->id, $post->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $post->name }}" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control">{{ $post->content }}</textarea>
        </div>
        <div class="form-group">
            <label for="parent_id">Parent Answer</label>
            <select class="form-control" name="parent_id">
                <option value="0">None</option>
                @foreach ($subject->posts as $post)
                    <option value="{{ $post->id }}" @if($post->id == $post->parent_id) selected @endif>{{ $post->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
