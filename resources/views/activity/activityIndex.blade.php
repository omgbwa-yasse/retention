@extends('index')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script >
    document.addEventListener('DOMContentLoaded', function() {


        document.querySelectorAll('.toggle-children').forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                var children = this.closest('li').querySelector('ul');
                if (children) {
                    children.classList.toggle('d-none');
                    this.textContent = children.classList.contains('d-none') ? '▶' : '▼';
                }
            });
        });
    });
</script>
@section('content')
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h2 fw-bold">{{ __('Plan de Classement') }}</h1>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="{{ route('mission.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Create New Mission
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="card-title mb-4">Organigram</h3>
                <div class="mission-tree">
                    <ul class="list-unstyled sortable">
                        @foreach($items as $mission)
                            @include('mission.partials.tree_item', ['mission' => $mission, 'level' => 0])
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <style>
        .mission-tree, .mission-tree ul {
            padding-left: 20px;
        }
        .mission-tree li {
            position: relative;
            margin-bottom: 10px;
        }
        .mission-tree li::before {
            content: "";
            position: absolute;
            top: 0;
            left: -15px;
            border-left: 1px solid #dee2e6;
            height: 100%;
        }
        .mission-tree li:last-child::before {
            height: 20px;
        }
        .mission-tree li::after {
            content: "";
            position: absolute;
            top: 20px;
            left: -15px;
            border-top: 1px solid #dee2e6;
            width: 15px;
        }
        .mission-item {
            border: 1px solid #dee2e6;
            padding: 10px;
            border-radius: 4px;
            background-color: #f8f9fa;
            display: inline-block;
            min-width: 200px;
        }
        .mission-item:hover {
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .toggle-children {
            cursor: pointer;
            color: #6c757d;
            margin-right: 5px;
        }
        .sortable-ghost {
            opacity: 0.5;
        }
        .badge-activity {
            background-color: #28a745;
            color: white;
        }
        .badge-mission {
            background-color: #007bff;
            color: white;
        }
    </style>

@endsection

@push('scripts')

@endpush
