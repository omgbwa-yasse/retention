<li>
    <div class="mission-item">
        @if($mission->children->isNotEmpty())
            <span class="toggle-children" title="{{ __('toggle_children') }}">
                {{ app()->getLocale() === 'ar' ? '◀' : '▶' }}
            </span>
        @endif

        <span class="badge {{ $level == 0 ? 'badge-activity' : 'badge-mission' }} mb-2">
            {{ $level == 0 ? __('mission') : __('activity') }}
        </span>

        <strong dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
            {{ $mission->code }}
        </strong> -
        <span dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
            {{ $mission->name }}
        </span>

        <a href="{{ route('mission.show', $mission->id) }}"
           class="btn btn-sm btn-outline-primary {{ app()->getLocale() === 'ar' ? 'ms-1' : 'me-1' }}">
            <i class="bi bi-eye"></i> {{ __('view') }}
        </a>

        <a href="{{ route('mission.edit', $mission->id) }}"
           class="btn btn-sm btn-outline-secondary">
            <i class="bi bi-pencil"></i> {{ __('edit') }}
        </a>

        <div class="small text-muted mt-1" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
            {{ Str::limit($mission->description, 50) }}
        </div>
    </div>

    @if($mission->children->isNotEmpty())
        <ul class="list-unstyled mt-2 sortable d-none">
            @foreach($mission->children as $childMission)
                @include('mission.partials.tree_item', [
                    'mission' => $childMission,
                    'level' => $level + 1
                ])
            @endforeach
        </ul>
    @endif
</li>
