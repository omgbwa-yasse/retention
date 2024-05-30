@extends('index')
@section('content')
<h1>Mettre à jour un sujet</h1>
        <form action="{{ route('subject.update', $subject) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $subject->name) }}">
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $subject->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Classes</label>
                <select class="form-select form-select-lg" name="class_id" id="" >
                            @foreach ($classes as $class)
                                <option value="{{ $class->id }}" {{ $class->id ==  $class->id ? 'selected' : '' }}>{{ $class->code }} - {{ $class->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </select>
            <button type="submit" class="btn btn-primary">Valider</button>
            <button type="reset" class="btn btn-primary">Annuler</button>
            </div>


        </form>



@endsection
