{{-- resources/views/charter/classes.blade.php --}}
<div class="overflow-x-auto" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
    <table class="compact-table table table-bordered">
        <thead>
        <tr>
            <th rowspan="2" class="text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}">
                {{ __('table_code') }}
            </th>
            <th rowspan="2" class="text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}">
                {{ __('table_title') }}
            </th>
            <th class="text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}">
                {{ __('table_legal_duration') }}
            </th>
            <th rowspan="2" class="text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}">
                {{ __('table_references') }}
            </th>
        </tr>
        </thead>
        <tbody>
        @foreach ($classes as $class)
            <tr>
                <td class="font-medium">{{ $class->code }}</td>
                <td>{{ $class->name }}</td>
                <td>
                    @if ($class->rules)
                        @foreach ($class->rules as $rule)
                            @if ($rule->duls)
                                @foreach ($rule->duls as $dul)
                                    <div class="status-badge status-valid">
                                        {{ $dul->duration }}
                                    </div>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </td>
                <td></td>
            </tr>
            @if ($class->children->isNotEmpty())
                @include('charter.classes', ['classes' => $class->children])
            @endif
        @endforeach
        </tbody>
    </table>
</div>
