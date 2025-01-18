@extends('index')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <!-- Main header -->
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h1 class="display-6 mb-2">{{ $rule->name }}</h1>
                        <p class="text-muted mb-0">{{ __('code') }}: {{ $rule->code }}</p>
                    </div>
                    <div class="text-end">
                        <span class="badge bg-{{ $rule->status->name??'ND' === 'Active' ? 'success' : 'secondary' }} mb-2">
                            {{ __('status : ' . strtolower($rule->status->name??'ND')) }}
                        </span>
                        <div class="text-muted small">
                            {{ __('country') }}: {{ $rule->country->name }}
                        </div>
                    </div>
                </div>

                <!-- Validation information -->
                <div class="bg-light p-3 rounded mb-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h6 class="text-uppercase text-muted small mb-2">{{ __('validation') }}</h6>
                            @if($rule->validated_at && $rule->validator)
                                <table class="table table-sm">
                                    <tr>
                                        <th class="ps-0 border-0">{{ __('validated_by') }}:</th>
                                        <td class="border-0">{{ $rule->validator->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="ps-0 border-0">{{ __('validation_date') }}:</th>
                                        <td class="border-0">{{ $rule->validated_at }}</td>
                                    </tr>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">{{ __('description') }}</h6>
                    <div class="border rounded p-3">
                        {{ $rule->description }}
                    </div>
                </div>

                <!-- Classifications -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">{{ __('classifications') }}</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>{{ __('classification_name') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($rule->classifications as $classification)
                                <tr>
                                    <td>{{ $classification->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted">{{ __('no_classifications') }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Duls -->
                <div>
                    <h6 class="text-uppercase text-muted small mb-2">{{ __('associated_duls') }}</h6>
                    <div class="border rounded mb-3">
                        <div class="table-responsive">
                            <table class="table table-sm mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th colspan="2" class="border-bottom">
                                        {{ $rule->name }}
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th class="w-25 bg-light">{{ __('duration') }}</th>
                                    <td>{{ $rule->duration }} {{ __('duration_years') }}</td>
                                </tr>
                                <tr>
                                    <th class="w-25 bg-light">{{ __('trigger') }}</th>
                                    <td>{{ $rule->trigger->name }}</td>
                                </tr>
                                <tr>
                                    <th class="w-25 bg-light">{{ __('sort') }}</th>
                                    <td>{{ $rule->sort->name }}</td>
                                </tr>
                                <tr>
                                    <th class="w-25 bg-light">{{ __('articles') }}</th>
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($rule->articles as $article)
                                                <span class="badge bg-light text-dark">
                                                        {{ $article->name }}
                                                    </span>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="card-footer bg-light text-muted small p-3">
                <div class="d-flex justify-content-between">
                    <span>{{ __('code') }}: {{ $rule->code }}</span>
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
        .table-sm > :not(caption) > * > * {
            padding: 0.5rem;
        }
        @if(app()->getLocale() === 'ar')
        .container {
            direction: rtl;
            text-align: right;
        }
        .text-end {
            text-align: left !important;
        }
        .ps-0 {
            padding-right: 0 !important;
            padding-left: initial !important;
        }
        @endif
    </style>
@endsection
