<!-- resources/views/classifications/subclasses.blade.php -->

<div class="table-responsive">
    <table class="table table-light table-bordered text-center align-middle">
        <tbody>
            <tr class="border-bottom border-end">
                <td rowspan="2" class="text-center align-middle">Cote</td>
                <td rowspan="2" class="text-center align-middle">Intitulé</td>
                <td rowspan="2" class="text-center align-middle">Vedette</td>
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
            <tr class="border-bottom border-end">
                <td>CM-1002</td>
                <td>Dossier du personnel</td>
                <td>Nom, reference, date, grade</td>
                <td>15 </td>
                <td>5 ans</td>
                <td> 888 </td>
                <td>7 ans</td>
                <td> 888 </td>
                <td>120 ans</td>
                <td> 99 </td>
                <td>14 articles</td>
            </tr>
            <tr class="border-bottom border-end">
                <td>CM-1002</td>
                <td>Mouvements du personnel</td>
                <td>nom, année, grade</td>
                <td>15 </td>
                <td>5 ans</td>
                <td> 888 </td>
                <td>10 ans</td>
                <td> 999 </td>
                <td>120 ans</td>
                <td> 99 </td>
                <td>14 articles</td>
            </tr>

        </tbody>
    </table>
</div>


    @foreach ($subclasses as $classe)
            {{ $classe->code }}

            {{ $classe->name }}
            @if ($classe->rules)
                {{ 'A/N' }}
            @endif

            <br>
            <br>
            <br>
            @if ($classe->children->isNotEmpty())
                    @include('mission.subclasses', ['subclasses' => $classe->children])
            @endif

    @endforeach

