<!-- resources/views/charter/classes.blade.php -->
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover shadow-sm">
        <thead class="table-light">
        <tr>
            <th rowspan="2" class="text-center align-middle bg-primary text-white">Cote</th>
            <th rowspan="2" class="text-center align-middle bg-primary text-white">Intitulé</th>
            <th rowspan="2" class="text-center align-middle bg-primary text-white">Typologies</th>
            <th colspan="2" class="text-center align-middle bg-success text-white">Les Bureaux</th>
            <th colspan="2" class="text-center align-middle bg-warning text-dark">Salle de préarchivage</th>
            <th colspan="2" class="text-center align-middle bg-danger text-white">Archives Historique</th>
            <th rowspan="2" class="text-center align-middle bg-info text-white">Références</th>
        </tr>
        <tr>
            <th class="text-center bg-success text-white">Délai</th>
            <th class="text-center bg-success text-white">Déclencheur</th>
            <th class="text-center bg-warning text-dark">Délai</th>
            <th class="text-center bg-warning text-dark">Déclencheur</th>
            <th class="text-center bg-danger text-white">Délai</th>
            <th class="text-center bg-danger text-white">Déclencheur</th>
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
                    @if ($class->rules)
                        @foreach ($class->rules as $rule)
                            @if ($rule->actives)
                                @foreach ($rule->actives as $active)
                                    {{ $active->duration }}<br>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </td>
                <td>
                    @if ($class->rules)
                        @foreach ($class->rules as $rule)
                            @if ($rule->actives)
                                @foreach ($rule->actives as $active)
                                    {{ $active->trigger->name }}<br>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </td>
                <td>
                    @if ($class->rules)
                        @foreach ($class->rules as $rule)
                            @if ($rule->duas)
                                @foreach ($rule->duas as $dua)
                                    {{ $dua->duration }}<br>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </td>
                <td>
                    @if ($class->rules)
                        @foreach ($class->rules as $rule)
                            @if ($rule->duas)
                                @foreach ($rule->duas as $dua)
                                    {{ $dua->trigger->name }}<br>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
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
                <td>
                    @if ($class->rules)
                        @foreach ($class->rules as $rule)
                            @if ($rule->duls)
                                @foreach ($rule->duls as $dul)
                                    {{ $dul->trigger->name }}<br>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </td>
                <td>
                    @if ($class->rules)
                        @foreach ($class->rules as $rule)
                            @if ($rule->articles)
                                @foreach ($rule->articles as $article)
                                    {{ $article->name }}<br>
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
