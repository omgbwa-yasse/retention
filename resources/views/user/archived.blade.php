@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Comptes archivés') }}</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(count($archivedUsers) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Nom') }}</th>
                                        <th>{{ __('Prénom') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Pays') }}</th>
                                        <th>{{ __('Archivé le') }}</th>
                                        <th>{{ __('Archivé par') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($archivedUsers as $user)
                                        <tr>
                                            <td>{{ $user->surname }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->country ? $user->country->name : 'N/A' }}</td>
                                            <td>{{ $user->archived_at ? $user->archived_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                            <td>{{ $user->archivedBy ? $user->archivedBy->name : 'N/A' }}</td>
                                            <td>
                                                <form action="{{ route('user.update', $user) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="is_archived" value="0">
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="bi bi-arrow-counterclockwise"></i> {{ __('Restaurer') }}
                                                    </button>
                                                </form>

                                                <form action="{{ route('user.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer définitivement cet utilisateur ?') }}')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i> {{ __('Supprimer') }}
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            {{ __('Aucun compte archivé.') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
