@php
    $indentation = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level);
@endphp

<tr class="charter-row" data-level="{{ $level }}">
    <td class="text-center">{{ $level + 1 }}</td>
    <td class="fw-bold">{{ $classification->code }}</td>
    <td>
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
    <td>
        @foreach($classification->typologies as $typology)
            <span class="badge bg-light text-dark mb-1">{{ $typology->name }}</span>
        @endforeach
    </td>

    @php
        $rules = $classification->rules;
        $hasRules = $rules->isNotEmpty();
    @endphp

        <!-- Délais actifs -->
    <td class="{{ $hasRules ? '' : 'table-light' }}">
        @if($hasRules)
            @foreach($rules as $rule)
                @foreach($rule->duls as $dul)
                    {{ $dul->duration }}<br>
                @endforeach
            @endforeach
        @endif
    </td>
    <td class="{{ $hasRules ? '' : 'table-light' }}">
        @if($hasRules)
            @foreach($rules as $rule)
                @foreach($rule->duls as $dul)
                    {{ $dul->trigger->name }}<br>
                @endforeach
            @endforeach
        @endif
    </td>

    <!-- Délais semi-actifs (si applicable dans votre système) -->
    <td class="{{ $hasRules ? '' : 'table-light' }}"></td>
    <td class="{{ $hasRules ? '' : 'table-light' }}"></td>

    <!-- Durée légale -->
    <td class="{{ $hasRules ? '' : 'table-light' }}">
        @if($hasRules)
            @foreach($rules as $rule)
                @foreach($rule->duls as $dul)
                    {{ $dul->duration }}<br>
                @endforeach
            @endforeach
        @endif
    </td>
    <td class="{{ $hasRules ? '' : 'table-light' }}">
        @if($hasRules)
            @foreach($rules as $rule)
                @foreach($rule->duls as $dul)
                    {{ $dul->trigger->name }}<br>
                @endforeach
            @endforeach
        @endif
    </td>

    <!-- Références -->
    <td>
        @if($hasRules)
            @foreach($rules as $rule)
                @foreach($rule->articles as $article)
                    <span class="badge bg-secondary">{{ $article->name }}</span><br>
                @endforeach
            @endforeach
        @endif
    </td>
</tr>
