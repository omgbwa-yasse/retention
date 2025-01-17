@extends('index')

@section('content')
    <div class="container-fluid py-4">
        <!-- Search form -->
        <div class="container-fluid py-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <form action="{{ route('public.search.advanced.results') }}" method="GET">
                        <!-- First row: Search term -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="term" name="term"
                                           value="{{ request('term') }}" placeholder="{{ __('search_placeholder') }}">
                                    <label for="term">{{ __('search_term') }}</label>
                                </div>
                            </div>
                        </div>

                        <!-- Second row: Type, Country, Dates -->
                        <div class="row mb-3">
                            <!-- Search type -->
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <select class="form-select" id="type" name="type">
                                        <option value="">{{ __('all_types') }}</option>
                                        <option value="rule" {{ request('type') == 'rule' ? 'selected' : '' }}>{{ __('rules') }}</option>
                                        <option value="class" {{ request('type') == 'class' ? 'selected' : '' }}>{{ __('classifications') }}</option>
                                        <option value="reference" {{ request('type') == 'reference' ? 'selected' : '' }}>{{ __('references') }}</option>
                                    </select>
                                    <label for="type">{{ __('type') }}</label>
                                </div>
                            </div>

                            <!-- Country -->
                            <div class="col-md-3">
                                <div class="form-floating">
                                    <select class="form-select" id="countries" name="country">
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}" {{ request('country') == $country->id ? 'selected' : '' }}>
                                                {{ $country->name }} ({{ $country->abbr }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="countries">{{ __('country') }}</label>
                                </div>
                            </div>

                            <!-- Dates -->
                            <div class="col-md-6">
                                <div class="row g-2">
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="date_from" name="date_from"
                                                   value="{{ request('date_from') }}">
                                            <label for="date_from">{{ __('date_start') }}</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-floating">
                                            <input type="date" class="form-control" id="date_to" name="date_to"
                                                   value="{{ request('date_to') }}">
                                            <label for="date_to">{{ __('date_end') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Third row: Search button -->
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-search"></i> {{ __('search') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Search results -->
            @if(isset($records) && $records->count() > 0)
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ __('search_results') }} ({{ $records->count() }} {{ __('results_found') }})</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>{{ __('table.type') }}</th>
                                    <th>{{ __('table.name') }}</th>
                                    <th>{{ __('table.description') }}</th>
                                    <th>{{ __('table.country') }}</th>
                                    <th>{{ __('table.date') }}</th>
                                    <th>{{ __('table.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($records as $record)
                                    <tr>
                                        <td>
                                            @switch($record['type'])
                                                @case('rule')
                                                    <span class="badge bg-primary">{{ __('badges.rule') }}</span>
                                                    @break
                                                @case('class')
                                                    <span class="badge bg-success">{{ __('badges.class') }}</span>
                                                    @break
                                                @case('reference')
                                                    <span class="badge bg-info">{{ __('badges.reference') }}</span>
                                                    @break
                                            @endswitch
                                        </td>
                                        <td>{{ $record['name'] }}</td>
                                        <td>{{ Str::limit($record['description'], 100) }}</td>
                                        <td>{{ $record['country']['name'] ?? __('not_available') }}</td>
                                        <td>{{ $record['created_at'] ? date('d/m/Y', strtotime($record['created_at'])) : __('not_available') }}</td>
                                        <td>
                                            @switch($record['type'])
                                                @case('rule')
                                                    <a href="{{ route('public.rules.show', $record['id']) }}" class="btn btn-sm btn-primary">
                                                        <i class="bi bi-eye"></i> {{ __('view') }}
                                                    </a>
                                                    @break
                                                @case('class')
                                                    <a href="{{ route('public.classes.show', $record['id']) }}" class="btn btn-sm btn-success">
                                                        <i class="bi bi-eye"></i> {{ __('view') }}
                                                    </a>
                                                    @break
                                                @case('reference')
                                                    <a href="{{ route('public.references.show', $record['id']) }}" class="btn btn-sm btn-info">
                                                        <i class="bi bi-eye"></i> {{ __('view') }}
                                                    </a>
                                                    @break
                                            @endswitch
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ $records->links() }}
                </div>
            @elseif(request()->has('term'))
                <div class="alert alert-info">
                    {{ __('no_results') }}
                </div>
            @endif
        </div>
    </div>

    <style>
        @if(app()->getLocale() === 'ar')
        .container-fluid {
            direction: rtl;
            text-align: right;
        }
        .bi {
            margin-left: 0.5rem;
            margin-right: 0;
        }
        .btn .bi {
            margin-left: 0.5rem;
            margin-right: 0;
        }
        @endif
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateExact = document.getElementById('date');
            const dateFrom = document.getElementById('date_from');
            const dateTo = document.getElementById('date_to');

            function toggleDateFields() {
                const isDateExactFilled = dateExact?.value !== '';
                if (dateFrom && dateTo && dateExact) {
                    dateFrom.disabled = isDateExactFilled;
                    dateTo.disabled = isDateExactFilled;

                    if (isDateExactFilled) {
                        dateFrom.value = '';
                        dateTo.value = '';
                    }
                }
            }

            if (dateExact) {
                dateExact.addEventListener('change', toggleDateFields);
                toggleDateFields();
            }
        });
    </script>
@endsection
