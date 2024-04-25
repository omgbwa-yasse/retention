<!-- resources/views/classifications/subclasses.blade.php -->
<ul class="list-group llist-group-vertical" style="margin-left: 40px">
@foreach ($subclasses as $subclass)
    <li class="list-group-item">
        {{ $subclass->code }} : {{ $subclass->name }}
        <a href="{{ route('activity.show', $item) }}" class="btn btn-primary mb-2" style="align:right">voir</a>
    </li>
        @if ($subclass->children->isNotEmpty())
                @include('mission.subclasses', ['subclasses' => $subclass->children])
        @endif

@endforeach
</ul>
