@extends('index')
@section('content')

    @foreach( $domaines as $domaine )


    <h1 class="display-7">{{ $domaine->code }} -  {{ $domaine->name }}</h1>
    <p class="">{{ $domaine->description }} </p>

    <!-- Horizontal under breakpoint -->
    <ul class="list-group list-group-horizontal">
        <li class="list-group-item bg-danger-subtle">Imprimer</li>
        <li class="list-group-item bg-success-subtle">Exporter</li>
        <li class="list-group-item bg-dark-subtle">Partager sur le forum</li>
        <li class="list-group-item bg-dark-subtle">Commentaires (12)</li>
    </ul>

    <div class="table-responsive">
        <table class="table table-grey">
            <thead>
                <tr class="">
                    <th scope="col">code</th>
                    <th scope="col">Activité</th>
                    <th scope="col">Ordre de classement</th>
                    <th scope="col">Typologies</th>
                    <th scope="col">Durée dans les bureaux</th>
                    <th scope="col">Déclencher</th>
                    <th scope="col">Dureée la salle de préarchivage</th>
                    <th scope="col">Déclencheur</th>
                    <th scope="col">Durée aux d'archives historiques (légale)</th>
                    <th scope="col">Référence juridique</th>
                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td scope="row">R1C1</td>
                    <td>R1C2</td>
                    <td>R1C3</td>
                    <td>R1C2</td>
                    <td>R1C3</td>
                    <td>R1C2</td>
                    <td>R1C3</td>
                    <td>R1C2</td>
                    <td>R1C3</td>
                    <td>R1C2</td>
                </tr>
                <tr class="">
                    <td scope="row">Item</td>
                    <td>Item</td>
                    <td>Item</td>
                    <td>Item</td>
                    <td>Item</td>
                    <td>Item</td>
                    <td>Item</td>
                    <td>Item</td>
                    <td>Item</td>
                    <td>Item</td>
                </tr>
            </tbody>
        </table>
    </div>

    @endforeach



@endsection
