<!-- resources/views/references/index.blade.php -->

@extends('index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Référentiels juridiques </h1>
                <a href="{{ route('reference.create') }}" class="btn btn-primary mb-3">Ajouter une référence</a>
                <a href="#" class="btn btn-danger mb-3">Panier</a>
                <a href="#" class="btn btn-danger mb-3">Imprimer</a>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                        @foreach ($references as $item)

                        <div class="list-group">
                            <label class="list-group-item">
                                <input class="form-check-input me-1" type="checkbox" value="" />
                                <h2>{{ $item->name }}</h2>
                                {{ $item->description }} <br>
                                @unless(optional($item->articles)->isEmpty())
                                    ({{ optional($item->articles)->count() }} article.s)
                                @endunless
                                <br>
                                    <a href="{{ route('reference-category.show', $item->category->id) }}"> {{ $item->category->name }} </a>
                            <br>
                                <a href=""> {{ $item->country_name }} </a>
                            <br>
                                <form action="{{ route('reference.destroy', $item->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                <a href="{{ route('reference.show', $item->id) }}" class="btn btn-sm btn-success">Voir plus</a>



                            </label>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
