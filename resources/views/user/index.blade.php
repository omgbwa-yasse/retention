@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Liste des comptes') }}</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(count($users) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>{{ __('Nom') }}</th>
                                        <th>{{ __('Prénom') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Pays') }}</th>
                                        <th>{{ __('Statut') }}</th>
                                        <th>{{ __('Activé') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        @if(!$user->is_archived)
                                        <tr>
                                            <td>{{ $user->surname }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->country ? $user->country->name : 'N/A' }}</td>
                                            <td>
                                                @if($user->status == 'superadmin')
                                                    <span class="badge bg-danger">{{ __('Super Admin') }}</span>
                                                @elseif($user->status == 'admin')
                                                    <span class="badge bg-warning">{{ __('Admin') }}</span>
                                                @else
                                                    <span class="badge bg-info">{{ __('Lecteur') }}</span>
                                                @endif

                                                @if(Auth::user()->status == 'superadmin' && Auth::id() != $user->id)
                                                    <button type="button" class="btn btn-sm btn-outline-secondary ms-2" data-bs-toggle="modal" data-bs-target="#changeStatusModal{{ $user->id }}">
                                                        <i class="bi bi-pencil-square"></i>
                                                    </button>

                                                    <!-- Modal for changing status -->
                                                    <div class="modal fade" id="changeStatusModal{{ $user->id }}" tabindex="-1" aria-labelledby="changeStatusModalLabel{{ $user->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="{{ route('user.updateStatus', $user) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="changeStatusModalLabel{{ $user->id }}">{{ __('Modifier le statut de') }} {{ $user->name }} {{ $user->surname }}</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="status">{{ __('Nouveau statut') }}</label>
                                                                            <select class="form-control" id="status" name="status">
                                                                                <option value="reader" {{ $user->status == 'reader' ? 'selected' : '' }}>{{ __('Lecteur') }}</option>
                                                                                <option value="admin" {{ $user->status == 'admin' ? 'selected' : '' }}>{{ __('Admin') }}</option>
                                                                                <option value="superadmin" {{ $user->status == 'superadmin' ? 'selected' : '' }}>{{ __('Super Admin') }}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                                                                        <button type="submit" class="btn btn-primary">{{ __('Enregistrer') }}</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->is_actived)
                                                    <span class="badge bg-success">{{ __('Oui') }}</span>
                                                @else
                                                    <span class="badge bg-danger">{{ __('Non') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(Auth::user()->status == 'superadmin' && Auth::id() != $user->id)
                                                    @if(!$user->is_actived)
                                                    <form action="{{ route('user.update', $user) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="is_actived" value="1">
                                                        <input type="hidden" name="actived_by" value="{{ Auth::id() }}">
                                                        <button type="submit" class="btn btn-success btn-sm">
                                                            <i class="bi bi-check-circle"></i> {{ __('Activer') }}
                                                        </button>
                                                    </form>
                                                    @endif

                                                    <form action="{{ route('user.update', $user) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="is_archived" value="1">
                                                        <input type="hidden" name="archived_by" value="{{ Auth::id() }}">
                                                        <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('{{ __('Êtes-vous sûr de vouloir archiver cet utilisateur ?') }}')">
                                                            <i class="bi bi-archive"></i> {{ __('Archiver') }}
                                                        </button>
                                                    </form>

                                                    <form action="{{ route('user.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer cet utilisateur ?') }}')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-trash"></i> {{ __('Supprimer') }}
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            {{ __('Aucun utilisateur trouvé.') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
