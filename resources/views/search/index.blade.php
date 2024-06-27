@extends('index')
@section('content')
    <div class="container">
        <h1>Search Results</h1>

        @if(count($references) > 0)
            <h2>References</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Description</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Pays</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($references as $reference)
                    <tr>
                        <td>{{ $reference->code }}</td>
                        <td>{{ $reference->name }}</td>
                        <td>{{ $reference->description }}</td>
                        <td><a href="{{ route('reference_categories.show', $reference->category->id) }}">{{ $reference->category->name }}</a></td>
{{--                        <td>{{ $reference->country->name }}</td>--}}
                        "pays "
                        <td>
                            <a href="{{ route('reference.show', $reference->id) }}" class="btn btn-primary btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        @if(count($rules) > 0)
            <h2>Rules</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Pays</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($rules as $rule)
                    <tr>
                        <td>{{ $rule->code }}</td>
                        <td>{{ $rule->name }}</td>
                        <td>{{ $rule->description }}</td>
                        <td>{{ $rule->status->name }}</td>
{{--                        <td>{{ $rule->country->name }}</td>--}}
                        "pays"
                        <td>
                            <a href="{{ route('rule.show', $rule->id) }}" class="btn btn-primary btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        @if(count($typologies) > 0)
            <h2>Typologies</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($typologies as $typology)
                    <tr>
                        <td>{{ $typology->name }}</td>
                        <td>{{ $typology->description }}</td>
                        <td><a href="{{ route('typology_categories.show', $typology->category->id) }}">{{ $typology->category->name }}</a></td>

                        <td>
                            <a href="{{ route('typology.show', $typology->id) }}" class="btn btn-primary btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

        @if(count($classifications) > 0)
            <h2>Classifications</h2>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Parent</th>
                    <th scope="col">Country</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($classifications as $classification)
                    <tr>
                        <td>{{ $classification->code }}</td>
                        <td>{{ $classification->name }}</td>
                        <td>{{ $classification->description }}</td>
                        <td>
{{--                            {{ $classification->parent->name }}--}}
                            "Classification Parente"
                        </td>
                        <td>
{{--                            {{ $classification->country->name }}--}}
                            "Pays "
                        </td>
                        <td>
                            <a href="{{ route('activity.show', $classification->id) }}" class="btn btn-primary btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif

    </div>
@endsection
