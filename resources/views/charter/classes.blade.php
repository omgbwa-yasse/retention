<!-- resources/views/classifications/subclasses.blade.php -->
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover shadow-sm">
        <thead class="table-light">
        <tr>
            <th rowspan="2" class="text-center align-middle bg-primary text-white">Cote</th>
            <th rowspan="2" class="text-center align-middle bg-primary text-white">Intitulé</th>
            <th rowspan="2" class="text-center align-middle bg-primary text-white">Typologies</th>
            <th colspan="2" class="text-center align-middle bg-success text-white">Active</th>
            <th colspan="2" class="text-center align-middle bg-warning text-dark">Semi-active</th>
            <th colspan="2" class="text-center align-middle bg-danger text-white">Durée légale</th>
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
                <td>TYPOLOGIE</td>
                <td>ACTIVES</td>
                <td>TRIGGER</td>
                <td>DUAS</td>
                <td>DUASname</td>
                <td>DUL</td>
                <td>DUL NAme</td>
                <td>ARTICLEs</td>
            </tr>
            @if ($class->children->isNotEmpty())
                @include('mission.subclasses', ['subclasses' => $class->children])
            @endif
        @endforeach
        </tbody>
    </table>
</div>
