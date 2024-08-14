@extends('index')

<style>
    .mission-tree {
        display: flex;
        justify-content: flex-start;
        padding: 20px 0;
        overflow-x: auto;
    }
    .mission-tree ul {
        padding: 20px 0 0 0;
        margin: 0;
        position: relative;
        transition: all 0.5s;
    }
    .mission-tree li {
        float: left;
        text-align: center;
        list-style-type: none;
        position: relative;
        padding: 20px 5px 0 5px;
        transition: all 0.5s;
    }
    .mission-tree li::before,
    .mission-tree li::after {
        content: '';
        position: absolute;
        top: 0;
        right: 50%;
        border-top: 2px solid #ccc;
        width: 50%;
        height: 20px;
    }
    .mission-tree li::after {
        right: auto;
        left: 50%;
        border-left: 2px solid #ccc;
    }
    .mission-tree li:only-child::after,
    .mission-tree li:only-child::before {
        display: none;
    }
    .mission-tree li:only-child {
        padding-top: 0;
    }
    .mission-tree li:first-child::before,
    .mission-tree li:last-child::after {
        border: 0 none;
    }
    .mission-tree li:last-child::before {
        border-right: 2px solid #ccc;
        border-radius: 0 5px 0 0;
    }
    .mission-tree li:first-child::after {
        border-radius: 5px 0 0 0;
    }
    .mission-tree ul ul::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        border-left: 2px solid #ccc;
        width: 0;
        height: 20px;
    }
    .mission-item {
        border: 1px solid #ccc;
        padding: 15px;
        border-radius: 8px;
        background-color: #fff;
        display: inline-block;
        min-width: 220px;
        max-width: 280px;
        position: relative;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .mission-item:hover {
        box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }
    .mission-item h3 {
        margin: 10px 0 0;
        padding: 0;
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }
    .mission-item p {
        margin: 5px 0 0;
        font-size: 14px;
        color: #666;
    }
    .mission-actions {
        margin-bottom: 10px;
    }
    .mission-actions a {
        padding: 4px 8px;
        font-size: 14px;
        margin: 0 2px;
        border-radius: 4px;
    }
    .level-indicator {
        position: absolute;
        top: -10px;
        left: 50%;
        transform: translateX(-50%);
        padding: 2px 8px;
        border-radius: 10px;
        font-size: 12px;
    }
    .activity {
        background-color: #28a745;
        color: white;
    }
    .mission {
        background-color: #007bff;
        color: white;
    }
</style>


@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h2 fw-bold text-primary">Missions - {{ $country->name }} ({{ $country->abbr }})</h1>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('mission.create') }}" class="btn btn-primary me-2">
                    <i class="bi bi-plus-circle"></i> Ajouter une mission
                </a>
                <a href="{{ route('mission.export') }}" class="btn btn-success">
                    <i class="bi bi-file-earmark-pdf"></i> Exporter en PDF
                </a>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('mission.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher par code ou nom..." value="{{ request('search') }}">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="bi bi-search"></i> Rechercher
                        </button>
                    </div>
                </form>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="mission-tree">
                    <ul>
                        @foreach ($items as $item)
                            @include('mission.partials.tree_item', ['mission' => $item, 'level' => 1])
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
