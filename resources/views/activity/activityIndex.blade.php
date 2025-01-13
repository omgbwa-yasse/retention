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
                <a href="{{ route('activity.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>Create New Activity
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="mission-tree">
                    <ul class="list-unstyled sortable">
                        @foreach($items as $mission)
                            @include('activity.partials.tree_item', ['mission' => $mission, 'level' => 0])
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <style>

@endsection
