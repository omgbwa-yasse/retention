@extends('index')

<style>
    :root {
        --transition-duration: 0.2s;
    }

    .country-details {
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 0.25rem 0.75rem rgba(0,0,0,0.1);
        transition: box-shadow var(--transition-duration) ease-in-out;
    }

    .country-header {
        padding: 1.5rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    .badge-country {
        font-weight: 500;
        font-size: 0.85rem;
        padding: 0.35em 0.65em;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all var(--transition-duration) ease-in-out;
    }

    @media (prefers-color-scheme: dark) {
        .country-header {
            background-color: rgba(255,255,255,0.05);
            border-color: rgba(255,255,255,0.1);
        }
    }
</style>

@section('content')
    <div class="container-fluid py-4">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('country.index') }}">{{ __('Countries') }}</a>
                </li>
                <li class="breadcrumb-item active">{{ $country->name }}</li>
            </ol>
        </nav>

        <div class="country-details bg-white mb-4">
            <div class="country-header d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-2">{{ $country->name }}</h1>
                    <div class="d-flex align-items-center">
                        <span class="badge badge-country bg-primary rounded-pill">{{ $country->abbr }}</span>
                        @if(isset($country->description))
                            <span class="ms-3 text-muted">{{ $country->description }}</span>
                        @endif
                    </div>
                </div>

                @if(auth()->check())
                    <div class="d-flex gap-2">
                        <a href="{{ route('country.edit', $country->id) }}" class="btn btn-outline-primary btn-action">
                            <i class="bi bi-pencil me-2"></i>
                            <span>{{ __('Edit') }}</span>
                        </a>
                        <form action="{{ route('country.destroy', $country->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-action"
                                    onclick="return confirm('{{ __("Are you sure you want to delete this country?") }}')">
                                <i class="bi bi-trash me-2"></i>
                                <span>{{ __('Delete') }}</span>
                            </button>
                        </form>
                    </div>
                @endif
            </div>

            <div class="p-4">
                {{-- Contenu détaillé du pays si nécessaire --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <h4 class="h5 mb-3">{{ __('Details') }}</h4>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th width="30%">{{ __('Name') }}</th>
                                        <td>{{ $country->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ __('Code') }}</th>
                                        <td>{{ $country->abbr }}</td>
                                    </tr>
                                    @if(isset($country->description))
                                    <tr>
                                        <th>{{ __('Description') }}</th>
                                        <td>{{ $country->description }}</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{-- Statistiques ou informations supplémentaires si disponibles --}}
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body">
                                <h4 class="h5 mb-3">{{ __('Statistics') }}</h4>
                                <p class="text-muted">
                                    {{ __('Additional data about this country will be displayed here.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('country.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-2"></i>
                {{ __('Back to Countries') }}
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add loading states to buttons
            document.querySelectorAll('a.btn, button.btn').forEach(button => {
                button.addEventListener('click', function() {
                    const icon = this.querySelector('i');
                    if (icon && !this.closest('form')) {
                        const originalClass = icon.className;
                        icon.className = 'bi bi-hourglass-split animate-spin';

                        // Restore original icon if navigation takes too long
                        setTimeout(() => {
                            if (document.body.contains(icon)) {
                                icon.className = originalClass;
                            }
                        }, 5000);
                    }
                });
            });
        });
    </script>

    <style>
        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>
@endsection
