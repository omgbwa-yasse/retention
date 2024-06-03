@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ __('User Profile') }}: {{ $user->name }}
                    </div>

                    <div class="card-body">
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Created at:</strong> {{ $user->created_at->diffForHumans() }}</p>

                        <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-warning mt-2">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
