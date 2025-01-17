@php
    // S'assurer que $level est défini, sinon utiliser 0 comme valeur par défaut
    $level = $level ?? 0;
    $indentation = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
@endphp

<tr class="charter-row" data-level="{{ $level }}">
    <td class="text-center">{{ $level + 1 }}</td>
    {{-- Vérifier que $classification existe et a une propriété code --}}
    <td class="fw-bold">{{ $classification->code ?? '' }}</td>
    <td>
        {!! $indentation !!}
        <span class="{{ $level === 0 ? 'fw-bold' : '' }}">
            {{ $classification->name ?? '' }}
        </span>
        @if($classification && $classification->description)
            <small class="d-block text-muted">
                {{ Str::limit($classification->description, 100) }}
            </small>
        @endif
    </td>
    <td>
        @if($classification && $classification->typologies)
            @foreach($classification->typologies as $typology)
                <span class="badge bg-light text-dark mb-1">{{ $typology->name }}</span>
            @endforeach
        @endif
    </td>

    @php
        $rules = $classification->rules ?? collect();
        $hasRules = $rules->isNotEmpty();
    @endphp

    {{-- Délais actifs --}}
    <td class="{{ $hasRules ? '' : 'table-light' }}">
        @if($hasRules)
            @foreach($rules as $rule)
                @if($rule->duls)
                    @foreach($rule->duls as $dul)
                        {{ $dul->duration ?? '' }}<br>
                    @endforeach
                @endif
            @endforeach
        @endif
    </td>

    {{-- Durée légale --}}
    <td class="{{ $hasRules ? '' : 'table-light' }}">
        @if($hasRules)
            @foreach($rules as $rule)
                @if($rule->duls)
                    @foreach($rule->duls as $dul)
                        {{ $dul->duration ?? '' }}<br>
                    @endforeach
                @endif
            @endforeach
        @endif
    </td>

    <td class="{{ $hasRules ? '' : 'table-light' }}">
        @if($hasRules)
            @foreach($rules as $rule)
                @if($rule->duls)
                    @foreach($rule->duls as $dul)
                        {{ $dul->trigger->name ?? '' }}<br>
                    @endforeach
                @endif
            @endforeach
        @endif
    </td>

    {{-- Références --}}
    <td>
        @if($hasRules)
            @foreach($rules as $rule)
                @if($rule->articles)
                    @foreach($rule->articles as $article)
                        <span class="badge bg-secondary">{{ $article->name ?? '' }}</span><br>
                    @endforeach
                @endif
            @endforeach
        @endif
    </td>
</tr>
