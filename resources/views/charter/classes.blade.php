<!-- resources/views/classifications/subclasses.blade.php -->

<div class="table-responsive">
    <table class="table table-light table-bordered text-center align-middle">
        <tbody>
            <tr class="border-bottom border-end">
                <td rowspan="2" class="text-center align-middle">Cote</td>
                <td rowspan="2" class="text-center align-middle">Intitulé</td>
                <td rowspan="2" class="text-center align-middle">Typologies</td>
                <td colspan="2" class="text-center align-middle">Active</td>
                <td colspan="2" class="text-center align-middle">Semi-active</td>
                <td colspan="2" class="text-center align-middle">Durée légale</td>
                <td rowspan="2" class="text-center align-middle">Références</td>
            </tr>
            <tr class="border-bottom border-end">
                <td>Delai</td>
                <td>Déclencheur</td>
                <td>Delai</td>
                <td>Déclencheur</td>
                <td>Delai</td>
                <td>Déclencheur</td>
            </tr>
            @foreach ($classes as $class)

            <tr class="border-bottom border-end">
                <td>{{  $class->code   }}</td>
                <td>{{  $class->name   }}</td>
                <td> </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td> artciles</td>
            </tr>

            @if ($class->children->isNotEmpty())
                    @include('mission.subclasses', ['subclasses' => $class->children])
            @endif
            @endforeach

        </tbody>
    </table>
</div>




