<!-- resources/views/charter/classes.blade.php -->
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover shadow-sm">
        <thead class="table-light">
        <tr>
            <th rowspan="2" class="text-center align-middle bg-primary text-white">Cote</th>
            <th rowspan="2" class="text-center align-middle bg-primary text-white">Intitulé</th>
            <th rowspan="2" class="text-center align-middle bg-primary text-white">Typologies</th>
            <th class="text-center bg-success text-white">Déclencheur</th>
            <th class="text-center bg-success text-white">Durée légale </th>
            <th rowspan="2" class="text-center align-middle bg-info text-white">Références</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($classes as $class)
            <tr>
            <td class="fw-bold">{{ $class->code }}</td>
            <td>{{ $class->name }}</td>
                <td>
                    @if ($class->typologies)
                        @foreach ($class->typologies as $typology)
                            {{ $typology->name }}<br>
                        @endforeach
                    @endif
            </td>
                <td>
                </td>
                <td>
                    @if ($class->rules)
                        @foreach ($class->rules as $rule)
                            @if ($rule->duls)
                                @foreach ($rule->duls as $dul)
                                    {{ $dul->duration }}<br>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </td>
            </tr>
            @if ($class->children->isNotEmpty())
                @include('charter.classes', ['classes' => $class->children])
            @endif
        @endforeach
        </tbody>
    </table>
</div>
