<div class="subclass">
    @foreach ($subclasses as $subclass)
        <div class="subclass-header">{{ $subclass->code }}: {{ $subclass->name }}</div>
        @if ($subclass->children->isNotEmpty())
            @include('mission.pdf_subclasses', ['subclasses' => $subclass->children])
        @endif
    @endforeach
</div>
