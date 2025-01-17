@extends('index')

@section('content')
    <div class="container my-5">
        @if($domaines->isEmpty())
            <div class="alert alert-warning" role="alert">
                {{ __('no_domains') }}
            </div>
        @else
            @foreach($domaines as $domaine)
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-gray text-primary">
                        <h2 class="mb-0">
                            <b>{{ $domaine->code }}</b> - {{ $domaine->name }} - {{ $country->name ?? '' }}
                        </h2>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $domaine->description }}</p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <button class="btn btn-outline-danger btn-sm"
                                    title="{{ __('title_print') }}"
                                    onclick="window.location.href='{{ route('charter.print', $domaine->id) }}'">
                                <i class="bi bi-printer me-1"></i> {{ __('print') }}
                            </button>
                            <button class="btn btn-outline-success btn-sm"
                                    title="{{ __('title_export') }}"
                                    onclick="window.location.href='{{ route('charter.export', $domaine->id) }}'">
                                <i class="bi bi-download me-1"></i> {{ __('export') }}
                            </button>
                            <button class="btn btn-outline-secondary btn-sm"
                                    title="{{ __('title_share_forum') }}"
                                    onclick="window.location.href='{{ route('subject.create', ['class_id' => $domaine->id]) }}'">
                                <i class="bi bi-share me-1"></i> {{ __('share_forum') }}
                            </button>
                            <button class="btn btn-outline-info btn-sm"
                                    title="{{ __('title_comments') }}"
                                    onclick="window.location.href='{{ route('subject.index') }}'">
                                <i class="bi bi-chat-dots me-1"></i> {{ __('comments') }}
                                <span class="badge bg-info text-white">{{ $domaine->subjects->count() }}</span>
                            </button>
                        </div>
                        @include('charter.classes', ['classes' => $domaine->children])
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    <style>
        @if(app()->getLocale() === 'ar')
    .container {
            direction: rtl;
            text-align: right;
        }
        .me-1 {
            margin-left: 0.25rem !important;
            margin-right: 0 !important;
        }
        .bi {
            margin-left: 0.25rem;
            margin-right: 0;
        }
        .btn .bi {
            margin-left: 0.25rem;
            margin-right: 0;
        }
        .d-flex {
            flex-direction: row-reverse;
        }
        @endif
    </style>
@endsection
