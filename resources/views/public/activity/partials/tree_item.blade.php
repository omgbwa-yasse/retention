<li>
    <div class="mission-item">
        @if($mission->children->isNotEmpty())
            <span class="toggle-children">▼</span>
        @endif
        <span class="badge {{ $level == 0 ? 'badge-activity' : 'badge-mission' }} mb-2">
            {{ $level == 0 ? 'Mission' : 'Activité' }}
        </span>
        <strong>{{ $mission->code }}</strong> - {{ $mission->name }} <a href="{{ route('mission.show', $mission->id) }}" class="btn btn-sm btn-outline-primary me-1">
                <i class="bi bi-eye"></i> Voir
            </a>
            <a href="{{ route('mission.edit', $mission->id) }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-pencil"></i> Éditer
            </a>
        <div class="small text-muted mt-1">{{ Str::limit($mission->description, 50) }}</div>



    </div>
    @if($mission->children->isNotEmpty())
        <ul class="list-unstyled mt-2 sortable">
            @foreach($mission->children as $childMission)
                @include('mission.partials.tree_item', ['mission' => $childMission, 'level' => $level + 1])
            @endforeach
        </ul>
    @endif
</li>
