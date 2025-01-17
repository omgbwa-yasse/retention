@extends('index')

@section('content')
    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <!-- Document header -->
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <div>
                        <h1 class="display-6 mb-2">{{ $reference->name }}</h1>
                        <div class="d-flex gap-3 text-muted small">
                            <span>
                                <i class="bi bi-folder"></i>
                                {{ __('category') }}: {{ $reference->category->name }}
                            </span>
                            <span>
                                <i class="bi bi-geo-alt"></i>
                                {{ __('country') }}: {{ $reference->country->name }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">{{ __('description') }}</h6>
                    <div class="bg-light p-3 rounded">
                        {{ $reference->description }}
                    </div>
                </div>

                <!-- Articles -->
                <div class="mb-4">
                    <h6 class="text-uppercase text-muted small mb-2">{{ __('associated_articles') }}</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>{{ __('article_name') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($reference->articles as $article)
                                <tr>
                                    <td>{{ $article->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted">{{ __('no_articles') }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Files -->
                <div>
                    <h6 class="text-uppercase text-muted small mb-2">{{ __('attached_documents') }}</h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>{{ __('filename') }}</th>
                                <th width="120" class="text-center">{{ __('action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($reference->files as $file)
                                <tr>
                                    <td class="align-middle">
                                        <i class="bi bi-file-earmark-text me-2"></i>
                                        {{ $file->name }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ $file->file_path }}"
                                           class="btn btn-sm btn-outline-primary"
                                           target="_blank">
                                            <i class="bi bi-eye me-1"></i>
                                            {{ __('view') }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-muted">{{ __('no_files') }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="card-footer bg-light text-muted small p-3">
                <div class="d-flex justify-content-between">
                    {{--<span>{{ __('document_generated') }} {{ date('d/m/Y') }}</span>--}}
                    <span>{{ __('reference') }}: {{ $reference->id }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional styles -->
    <style>
        .table {
            margin-bottom: 0;
        }
        .table > :not(caption) > * > * {
            padding: 0.5rem;
        }
        .btn-sm {
            padding: 0.25rem 0.5rem;
        }
        @if(app()->getLocale() === 'ar')
        .container {
            direction: rtl;
            text-align: right;
        }
        .me-1, .me-2 {
            margin-left: 0.25rem !important;
            margin-right: 0 !important;
        }
        .bi {
            margin-left: 0.5rem;
            margin-right: 0;
        }
        @endif
    </style>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection
