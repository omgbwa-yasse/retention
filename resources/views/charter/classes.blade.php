<!-- resources/views/classifications/subclasses.blade.php -->
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead class="table-light">
        <tr>
            <th rowspan="2" class="text-center align-middle">Cote</th>
            <th rowspan="2" class="text-center align-middle">Intitulé</th>
            <th rowspan="2" class="text-center align-middle">Typologies</th>
            <th colspan="2" class="text-center align-middle">Active</th>
            <th colspan="2" class="text-center align-middle">Semi-active</th>
            <th colspan="2" class="text-center align-middle">Durée légale</th>
            <th rowspan="2" class="text-center align-middle">Références</th>
        </tr>
        <tr>
            <th class="text-center">Délai</th>
            <th class="text-center">Déclencheur</th>
            <th class="text-center">Délai</th>
            <th class="text-center">Déclencheur</th>
            <th class="text-center">Délai</th>
            <th class="text-center">Déclencheur</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($classes as $class)
            <tr>
                <td>{{ $class->code }}</td>
                <td>{{ $class->name }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>articles</td>
            </tr>
            @if ($class->children->isNotEmpty())
                @include('mission.subclasses', ['subclasses' => $class->children])
            @endif
        @endforeach
        </tbody>
    </table>
</div>
