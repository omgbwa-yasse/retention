<ul class="list-group list-group-vertical" style="margin-left: 40px" id="parent">
    @foreach ($subclasses as $subclass)
      <li class="list-group-item" id="child">
        {{ $subclass->code }} : {{ $subclass->name }}
        <a href="{{ route('activity.show', $subclass) }}" class="btn btn-primary mb-2 float-end">Voir</a>

        @if ($subclass->children->isNotEmpty())
          @include('mission.subclasses', ['subclasses' => $subclass->children])
        @endif
      </li>
    @endforeach
  </ul>
