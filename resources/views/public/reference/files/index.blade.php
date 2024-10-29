@extends('index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Files for {{ $reference->name }}</h1>
            <a href="{{ route('reference.show', $reference) }}" class="btn btn-primary mb-3">Retour </a>
            <a href="{{ route('reference.file.create', $reference) }}" class="btn btn-primary mb-3">Ajouter un fichier</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>File</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($files as $file)
                    <tr>
                        <td>{{ $file->name }}</td>
                        <td>
                            <a href="{{ route('reference.file.download', [$reference, $file]) }}">Download</a></td>
                        <td>
                            <a href="{{ route('reference.file.edit', [$reference, $file]) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ route('reference.file.destroy', [$reference, $file]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
