{{-- classes.blade.php --}}
<div class="table-responsive" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    @php $currentLevel = $level ?? 0; @endphp
    <table class="table table-hover mb-0">
        <thead class="bg-light">
        <tr>
            <th class="text-{{ app()->getLocale() === 'ar' ? 'end' : 'start' }} py-3 px-4" width="15%">
                {{ __('table_code') }}
            </th>
            <th class="text-{{ app()->getLocale() === 'ar' ? 'end' : 'start' }} py-3 px-4" width="25%">
                {{ __('table_title') }}
            </th>
            <th class="text-{{ app()->getLocale() === 'ar' ? 'end' : 'start' }} py-3 px-4" width="30%">
                {{ __('table_legal_duration') }}
            </th>
            <th class="text-{{ app()->getLocale() === 'ar' ? 'end' : 'start' }} py-3 px-4" width="30%">
                {{ __('table_references') }}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($classes as $class)
            <tr class="searchable-row hover:bg-gray-50 transition-colors">
                <td class="py-3 px-4">
                    <div class="d-flex align-items-center">
                        @if($currentLevel > 0)
                            <div style="width: {{ $currentLevel * 20 }}px"></div>
                        @endif
                        @if($class->children->isNotEmpty())
                            <button class="btn btn-link btn-sm p-0 me-2 toggle-children"
                                    data-class-id="{{ $class->id }}"
                                    aria-expanded="false"
                                    aria-controls="children-{{ $class->id }}">
                                <i class="bi bi-chevron-right text-primary transition-transform"></i>
                            </button>
                        @endif
                        <span class="fw-medium">{{ $class->code }}</span>
                    </div>
                </td>
                <td class="py-3 px-4">{{ $class->name }}</td>
                <td class="py-3 px-4">
                    @if($class->rules->isNotEmpty())
                        <div class="d-flex flex-column gap-2">
                            @foreach ($class->rules as $rule)
                                <div class="d-flex align-items-center">
{{--                                    <span class="fw-medium me-2">{{ $rule->code }}</span>--}}
{{--                                    <span class="me-2">-</span>--}}
{{--                                    <span>{{ $rule->name }}:</span>--}}
                                    <span class="badge bg-secondary rounded-pill ms-2">
                                            {{ $rule->duration }}
                                        </span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </td>
                <td class="py-3 px-4">
                    @if($class->rules->isNotEmpty())
                        <div class="d-flex flex-column gap-2">
                            @foreach ($class->rules as $rule)
                                @foreach ($rule->articles as $article)
                                    <div class="d-flex align-items-center">
                                        <span class="fw-medium me-2">{{ $article->code }}</span>
                                        <span class="me-2">-</span>
                                        <span>{{ $article->name }}</span>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    @endif
                </td>
            </tr>
            @if ($class->children->isNotEmpty())
                <tr class="children-row d-none"
                    data-parent="{{ $class->id }}"
                    id="children-{{ $class->id }}">
                    <td colspan="4" class="p-0">
                        @include('charter.classes', [
                            'classes' => $class->childrenRecursive,
                            'level' => $currentLevel + 1
                        ])
                    </td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>

<style>
    .table > :not(caption) > * > * {
        vertical-align: middle;
    }

    .table tbody tr:hover {
        background-color: rgba(0,0,0,0.02);
    }

    .transition-colors {
        transition: background-color 0.2s ease-in-out;
    }

    .transition-transform {
        transition: transform 0.2s ease-in-out;
    }

    .toggle-children.expanded .bi-chevron-right {
        transform: rotate(90deg);
    }

    .badge {
        font-weight: 500;
    }

    @if(app()->getLocale() === 'ar')
.me-1, .me-2 {
        margin-left: 0.25rem !important;
        margin-right: 0 !important;
    }

    .ms-1, .ms-2 {
        margin-right: 0.25rem !important;
        margin-left: 0 !important;
    }
    @endif
</style>
