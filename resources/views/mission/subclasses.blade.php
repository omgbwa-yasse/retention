<!-- resources/views/classifications/subclasses.blade.php -->

@foreach ($subclasses as $subclass)
    <li>
        {{ $subclass->name }}
        @if ($subclass->children->isNotEmpty())
            <ul>
                @include('mission.subclasses', ['subclasses' => $subclass->descendants])
            </ul>
        @endif
    </li>
@endforeach
