@extends('index')

@php
use Illuminate\Support\Facades\Auth;
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="mb-0">{{ __('Détails de la proposition') }}</h3>
                    <a href="{{ route('proposal.index') }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-1"></i> {{ __('Retour') }}
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">{{ $proposal->title }}</h4>
                            <span class="badge @if($proposal->status == 'pending') bg-warning text-dark @elseif($proposal->status == 'approved') bg-success @else bg-danger @endif">
                                {{ $proposal->status == 'pending' ? __('En attente') : ($proposal->status == 'approved' ? __('Approuvée') : __('Rejetée')) }}
                            </span>
                        </div>
                        <p class="text-muted mb-0">
                            {{ __('Proposé par') }}: {{ $proposal->name }} ({{ $proposal->email }})
                        </p>
                        <p class="text-muted">
                            {{ __('Date de soumission') }}: {{ $proposal->created_at->format('d/m/Y H:i') }}
                        </p>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">{{ __('Description') }}</h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">{!! nl2br(e($proposal->description)) !!}</p>
                        </div>
                    </div>

                    @if($proposal->attachments->count() > 0)
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">{{ __('Pièces jointes') }}</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($proposal->attachments as $attachment)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-paperclip me-2"></i>
                                        {{ $attachment->original_filename }}
                                        <small class="text-muted ms-2">
                                            ({{ round($attachment->file_size / 1024) }} KB)
                                        </small>
                                    </div>
                                    <a href="{{ route('proposal.attachment.download', $attachment->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-download"></i> {{ __('Télécharger') }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    @if(Auth::user()->status == 'superadmin')
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">{{ __('Actions') }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('proposal.update', $proposal->id) }}" method="POST" class="d-flex align-items-center">
                                @csrf
                                @method('PUT')
                                <div class="me-3">
                                    <label for="status" class="form-label">{{ __('Changer le statut:') }}</label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="pending" {{ $proposal->status == 'pending' ? 'selected' : '' }}>{{ __('En attente') }}</option>
                                        <option value="approved" {{ $proposal->status == 'approved' ? 'selected' : '' }}>{{ __('Approuver') }}</option>
                                        <option value="rejected" {{ $proposal->status == 'rejected' ? 'selected' : '' }}>{{ __('Rejeter') }}</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">{{ __('Mettre à jour') }}</button>
                            </form>

                            <hr>

                            <div class="d-flex justify-content-end">
                                <form action="{{ route('proposal.destroy', $proposal->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer cette proposition?') }}')">
                                        <i class="fas fa-trash me-1"></i> {{ __('Supprimer') }}
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
