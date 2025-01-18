@extends('index')

@section('content')
    <div class="container-fluid py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('public.search') }}">{{ __('home') }}</a>
                </li>
                @if($classification->parent)
                    <li class="breadcrumb-item">
                        <a href="{{ route('public.charter', $classification->parent->id) }}">
                            {{ $classification->parent->name }}
                        </a>
                    </li>
                @endif
                <li class="breadcrumb-item active">{{ $classification->name }}</li>
            </ol>
        </nav>

        <div class="card shadow-sm border-0">
            <!-- Charter header -->
            <div class="card-header bg-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">{{ $rootClassification->code }} - {{ $rootClassification->name }}</h4>
                        @if($rootClassification->description)
                            <p class="mb-0 opacity-75">{{ $rootClassification->description }}</p>
                        @endif
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('public.charter.pdf', $rootClassification->id) }}"
                           class="btn btn-light"
                           title="{{ __('download_pdf') }}">
                            <i class="fas fa-file-pdf"></i>
                        </a>
                        {{-- <a href="{{ route('public.charter.excel', $rootClassification->id) }}"--}}
                        {{-- class="btn btn-light"--}}
                        {{-- title="{{ __('download_excel') }}">--}}
                        {{-- <i class="fas fa-file-excel"></i>--}}
                        {{-- </a>--}}
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <!-- Hierarchical table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead class="table-light">
                        <tr>
                            <th rowspan="2" class="align-middle">{{ __('level') }}</th>
                            <th rowspan="2" class="align-middle">{{ __('code') }}</th>
                            <th rowspan="2" class="align-middle">{{ __('title') }}</th>
                            <th colspan="1" class="text-center bg-warning text-white">{{ __('legal_duration') }}</th>
                            <th rowspan="2" class="align-middle">{{ __('references') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <!-- Parent -->
                        @include('public.charter.row', ['classification' => $rootClassification, 'level' => 0])

                        <!-- Recursive children -->
                        @foreach($rootClassification->childrenRecursive as $child)
                            @include('public.charter.row', [
                                'classification' => $child,
                                'level' => $child->getLevel()
                            ])
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
