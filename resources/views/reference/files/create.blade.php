@extends('index')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Add File for {{ $reference->name }}</h1>
            <form action="{{ route('reference.file.store', $reference) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="file">File</label>
                    <input type="file" name="file" id="file" class="form-control-file" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload File</button>
            </form>
        </div>
    </div>
</div>
@endsection
