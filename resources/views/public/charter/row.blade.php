{{-- classes/view.blade.php --}}
@php
    $indentation = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
    $rules = $classification->rules;
    $hasRules = $rules->isNotEmpty();
@endphp

<tr class="charter-row hover:bg-gray-50 transition-colors" data-level="{{ $level }}">
    <td class="fw-bold text-center" width="5%">{{ $level + 1 }}</td>

    <td class="fw-bold" width="10%">{{ $classification->code }}</td>

    <td width="25%">
        {!! $indentation !!}
        <span class="{{ $level === 0 ? 'fw-bold' : '' }}">
            {{ $classification->name }}
        </span>
        @if($classification->description)
            <small class="d-block text-muted">
                {{ Str::limit($classification->description, 100) }}
            </small>
        @endif
    </td>

    {{-- Durée légale --}}
    <td class="{{ $hasRules ? '' : 'table-light' }}" width="30%">
        @if($hasRules)
            <div class="d-flex flex-column gap-2">
                @foreach($rules as $rule)
                    <div class="d-flex align-items-center">
                        @if($rule->duration)
                            <span class="badge bg-secondary rounded-pill ms-2">
                                {{ $rule->duration }}
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </td>

    {{-- Références --}}
    <td width="30%">
        @if($hasRules)
            <div class="d-flex flex-column gap-2">
                @foreach($rules as $rule)
                    @if($rule->articles)
                        @foreach($rule->articles as $article)
                            <div class="d-flex align-items-center">
                                <span class="fw-medium me-2">{{ $article->code }}</span>
                                <span class="me-2">-</span>
                                <span>{{ $article->name }}</span>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            </div>
        @endif
    </td>
</tr>

@if(isset($classification->children))
    @foreach($classification->children as $child)
        @include('public.charter.row', [
            'classification' => $child,
            'level' => $level + 1
        ])
    @endforeach
@endif
