<ul class="list-group list-group-vertical" id="subclass-{{ $item->id }}" style="margin-left: 40px">
    @foreach ($subclasses as $subclass)
        <li class="list-group-item">
            {{ $subclass->code }} : {{ $subclass->name }}
            <a href="{{ route('activity.show', $subclass) }}" class="btn btn-primary mb-2 float-end">Voir</a>
            @if ($subclass->children->isNotEmpty())
                <a class="toggle-subclass collapsed" data-toggle="collapse" href="#subclass-{{ $subclass->id }}"
                   aria-expanded="false" aria-controls="subclass-{{ $subclass->id }}" id="toggle-icon-{{ $subclass->id }}">
                    <i class="bi bi-plus-circle" id="plus-icon-{{ $subclass->id }}"></i>
                    <i class="bi bi-dash-circle" id="dash-icon-{{ $subclass->id }}" style="display: none;"></i>
                </a>
            @endif
        </li>
        @if ($subclass->children->isNotEmpty())
            <div class="collapse" id="subclass-{{ $subclass->id }}">
                @include('mission.subclasses', ['subclasses' => $subclass->children])
            </div>
        @endif
    @endforeach
</ul>
