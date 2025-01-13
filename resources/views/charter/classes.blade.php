{{-- resources/views/charter/classes.blade.php --}}
<div class="overflow-x-auto">
    <table class="compact-table table table-bordered">
        <thead>
        <tr>
            <th rowspan="2" class="text-left">Cote</th>
            <th rowspan="2" class="text-left">Intitulé</th>
            <th class="text-left">Durée légale</th>
            <th rowspan="2" class="text-left">Références</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($classes as $class)
            <tr>
                <td class="font-medium">{{ $class->code }}</td>
                <td>{{ $class->name }}</td>
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
