{{-- resources/views/charter/classes.blade.php --}}
<div class="overflow-x-auto">
    <table class="compact-table">
        <thead>
        <tr>
            <th rowspan="2" class="text-center">Cote</th>
            <th rowspan="2" class="text-center">Intitulé</th>
            <th rowspan="2" class="text-center">Typologies</th>
            <th class="text-center">Déclencheur</th>
            <th class="text-center">Durée légale</th>
            <th rowspan="2" class="text-center">Références</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($classes as $class)
            <tr>
                <td class="font-medium">{{ $class->code }}</td>
                <td>{{ $class->name }}</td>
                <td>
                    @if ($class->typologies)
                        @foreach ($class->typologies as $typology)
                            <div class="validator-chip">
                                {{ $typology->name }}
                            </div>
                        @endforeach
                    @endif
                </td>
                <td></td>
                <td>
                    @if ($class->rules)
                        @foreach ($class->rules as $rule)
                            @if ($rule->duls)
                                @foreach ($rule->duls as $dul)
                                    <div class="status-badge status-valid">
                                        {{ $dul->duration }}
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </td>
                <td></td>
            </tr>
            @if ($class->children->isNotEmpty())
                @include('charter.classes', ['classes' => $class->children])
            @endif
        @endforeach
        </tbody>
    </table>
</div>
