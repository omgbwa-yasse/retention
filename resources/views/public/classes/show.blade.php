@extends('index')

@section('content')
    <div class="container py-4">
        <!-- Document header -->
        <div class="card shadow-sm mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h1 class="display-6 mb-2">{{ $class->name }}</h1>
                        <p class="text-muted mb-0">{{ __('reference_code') }}: {{ $class->code }}</p>
                    </div>
                    <div class="text-end">
                        <div class="text-muted small">
                            {{ __('created_by') }}: {{ $class->user->name }}
                            <br>
                            {{ __('country') }}: {{ $class->country->name }}
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">{{ __('description') }}</h6>
                    <p class="mb-0">{{ $class->description }}</p>
                </div>

                <!-- Classification -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">{{ __('classification') }}</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm">
                                <tr>
                                    <th class="bg-light w-25">{{ __('parent') }}</th>
                                    <td>{{ $class->parent ? $class->parent->name : __('undefined') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Subclasses -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">{{ __('subclasses') }}</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>{{ __('name') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($class->childrenRecursive as $child)
                                <tr>
                                    <td>{{ $child->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted">{{ __('no_subclasses') }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Rules -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">{{ __('applicable_rules') }}</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>{{ __('rule') }}</th>
                                <th>{{ __('duls') }}</th>
                                <th>{{ __('trigger') }}</th>
                                <th>{{ __('articles') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($class->rules as $rule)
                                <tr>
                                    <td class="fw-medium">{{ $rule->name }}</td>
                                    <td>{{ $rule->duls->name }}</td>
                                    <td>{{ $rule->duls->trigger->name }}</td>
                                    <td>
                                        @foreach($rule->articles as $article)
                                            <span class="badge bg-light text-dark me-1">{{ $article->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-muted">{{ __('no_rules') }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Typologies -->
                <div>
                    <h6 class="text-uppercase text-muted small mb-2">{{ __('typologies') }}</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>{{ __('typology_name') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($class->typologies as $typology)
                                <tr>
                                    <td>{{ $typology->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted">{{ __('no_typologies') }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Document footer -->
            <div class="card-footer bg-light text-muted small p-3">
                <div class="d-flex justify-content-between">
                    <span>{{ __('generated_on') }} {{ date('d/m/Y') }}</span>
                    <span>{{ __('reference') }}: {{ $class->code }}</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        .table {
            margin-bottom: 0;
        }
        .table > :not(caption) > * > * {
            padding: 0.5rem;
        }
        .badge {
            font-weight: normal;
        }
        @if(app()->getLocale() === 'ar')
        .container {
            direction: rtl;
            text-align: right;
        }
        .text-end {
            text-align: left !important;
        }
        .me-1 {
            margin-left: 0.25rem !important;
            margin-right: 0 !important;
        }
        @endif
    </style>
@endsection
