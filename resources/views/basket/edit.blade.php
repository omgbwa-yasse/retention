
@extends('index')

@section('content')

<div class="container">
    <h1>Edit Basket</h1>
    <form action="{{ route('basket.update', $basket) }}" method="POST">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $basket->name) }}">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $basket->description) }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      @if(!empty($basketTypes))
        <div class="mb-3">
            <label for="basket_type_id" class="form-label">Basket Type</label>
            <select name="basket_type_id" id="basket_type_id" class="form-select @error('basket_type_id') is-invalid @enderror">
            <option value="">Select Basket Type</option>
            @foreach ($basketTypes as $basketType)
                <option value="{{ $basketType->id }}" {{ old('basket_type_id', $basket->basket_type_id) == $basketType->id ? 'selected' : '' }}>
                {{ $basketType->name }}
                </option>
            @endforeach
            </select>
            @error('basket_type_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
      @endif

      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>

@endsection

