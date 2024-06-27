<ul class="list-group list-group-vertical" id="subclass-{{ $item->id }}" style="margin-left: 40px">
    @foreach ($subclasses as $subclass)
        <li class="list-group-item">
            {{ $subclass->code }} : {{ $subclass->name }}
            <a href="{{ route('activity.show', $subclass) }}" class="btn btn-primary mb-2 float-end">Voir</a>
            @if ($subclass->children->isNotEmpty())
                @include('mission.subclasses', ['subclasses' => $subclass->children])
            @endif
        </li>
    @endforeach
</ul>
