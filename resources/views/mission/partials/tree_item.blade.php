<li>
    <div class="mission-item">
        @if($level == 1)
            <span class="level-indicator activity">Activité</span>
        @else
            <span class="level-indicator mission">Mission</span>
        @endif
        <div class="mission-actions">
            <a href="{{ route('mission.show', $mission->id) }}" class="btn btn-sm btn-outline-info" title="Voir">
                <i class="bi bi-eye"></i>
            </a>
            <a href="{{ route('mission.edit', $mission->id) }}" class="btn btn-sm btn-outline-primary" title="Éditer">
                <i class="bi bi-pencil"></i>
            </a>
        </div>
        <h3>{{ $mission->code }}</h3>
        <p>{{ $mission->name }}</p>
    </div>
    @if($mission->children->isNotEmpty())
        <ul>
            @foreach($mission->children as $child)
                @include('mission.partials.tree_item', ['mission' => $child, 'level' => $level + 1])
            @endforeach
        </ul>
    @endif
</li>
