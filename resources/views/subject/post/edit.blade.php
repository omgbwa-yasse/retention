@extends('index')

@section('content')
    <div class="container">
        <h1>Modifier une réponse</h1>
        <form action="{{ route('subject.post.updatePost', [$subject->id, $post->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" name="name" value="{{ $post->name }}" required>
            </div>

            <div class="form-group">
                <label for="content">Contenu</label>
                <textarea name="content" id="content" class="form-control">{{ $post->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="parent_id">Réponse parente</label>
                <select class="form-control" name="parent_id">
                    <option value="0">Aucune</option>
                    @foreach ($subject->posts as $post)
                        <option value="{{ $post->id }}" @if($post->id == $post->parent_id) selected @endif>{{ $post->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
@endsection
