<ul class="list-group list-group-flush ms-4">
    @if (isset($subclasses))
        @foreach ($subclasses as $subclass)

            <li class="list-group-item border-0"><hr>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        @if ($subclass->children->isNotEmpty())
                            <a class="toggle-subclass collapsed me-2" data-bs-toggle="collapse" href="#subclass-{{ $subclass->id }}" role="button" aria-expanded="false" aria-controls="subclass-{{ $subclass->id }}">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        @endif
                        <span class="fw-bold">{{ $subclass->code ?? '' }}</span>: {{ $subclass->name ?? '' }}
                    </div>
                    @if (isset($subclass->id))
                        <a href="{{ route('activity.show', $subclass) }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>
                    @endif
                </div>
                @if ($subclass->children->isNotEmpty())
                    <div class="collapse mt-2" id="subclass-{{ $subclass->id ?? '' }}">
                        @include('mission.subclasses', ['subclasses' => $subclass->children ?? []])
                    </div>
                @endif
            </li>
        @endforeach
    @endif
</ul>
