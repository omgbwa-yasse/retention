@extends('index')

@php
use Illuminate\Support\Facades\Auth;
@endphp

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">{{ __('Propositions d\'idées') }}</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($proposals->isEmpty())
                        <div class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="lead">{{ __('Aucune proposition n\'est disponible pour le moment.') }}</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('Titre') }}</th>
                                        <th>{{ __('Proposé par') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Statut') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proposals as $proposal)
                                        <tr>
                                            <td>{{ $proposal->title }}</td>
                                            <td>{{ $proposal->name }}</td>
                                            <td>{{ $proposal->created_at->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if($proposal->status == 'pending')
                                                    <span class="badge bg-warning text-dark">{{ __('En attente') }}</span>
                                                @elseif($proposal->status == 'approved')
                                                    <span class="badge bg-success">{{ __('Approuvée') }}</span>
                                                @elseif($proposal->status == 'rejected')
                                                    <span class="badge bg-danger">{{ __('Rejetée') }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('proposal.show', $proposal->id) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    @if(Auth::user()->status == 'superadmin')
                                                    <form action="{{ route('proposal.destroy', $proposal->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer cette proposition?') }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $proposals->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
