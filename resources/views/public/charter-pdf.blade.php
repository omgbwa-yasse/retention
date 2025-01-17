<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __('retention_charter') }} - {{ $classification->code }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            color: #0d6efd;
            margin-bottom: 10px;
        }
        .subtitle {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 10px;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .section-header {
            background-color: #e9ecef;
            font-weight: bold;
        }
        .badge {
            background-color: #f8f9fa;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            color: #666;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #666;
            padding: 10px 0;
            border-top: 1px solid #ddd;
        }
        .page-number:before {
            content: counter(page);
        }
        @if(app()->getLocale() === 'ar')
        body {
            direction: rtl;
        }
        .title, .subtitle, th, td {
            text-align: right;
        }
        @endif
    </style>
</head>
<body>
<div class="header">
    <div class="title">{{ $classification->code }} - {{ $classification->name }}</div>
    <div class="subtitle">{{ __('document_retention_charter') }}</div>
</div>

<!-- Table of Contents -->
<div style="page-break-after: always;">
    <h2>{{ __('table_of_contents') }}</h2>
    <ul>
        @foreach($classification->childrenRecursive as $class)
            <li>{{ $class->code }} - {{ $class->name }}</li>
        @endforeach
    </ul>
</div>

<h2>{{ __('classes') }}</h2>
<table>
    <thead>
    <tr>
        <th>{{ __('code') }}</th>
        <th>{{ __('title') }}</th>
        <th>{{ __('typologies') }}</th>
        <th>{{ __('legal_duration_delay') }}</th>
        <th>{{ __('legal_duration_trigger') }}</th>
        <th>{{ __('references') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($classification->childrenRecursive as $class)
        <tr>
            <td>{{ $class->code }}</td>
            <td>{{ $class->name }}</td>
            <td>
                @if ($class->typologies)
                    @foreach ($class->typologies as $typology)
                        {{ $typology->name }}<br>
                    @endforeach
                @endif
            </td>
            <td>
                @if ($class->rules)
                    @foreach ($class->rules as $rule)
                        @if ($rule->actives)
                            @foreach ($rule->actives as $active)
                                {{ $active->duration }}<br>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </td>
            <td>
                @if ($class->rules)
                    @foreach ($class->rules as $rule)
                        @if ($rule->actives)
                            @foreach ($rule->actives as $active)
                                {{ $active->trigger->name }}<br>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </td>
            <td>
                @if ($class->rules)
                    @foreach ($class->rules as $rule)
                        @if ($rule->articles)
                            @foreach ($rule->articles as $article)
                                {{ $article->name }}<br>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="footer">
    {{ __('page') }} <span class="page-number"></span>
    <br>
    {{ __('generated_on') }} {{ now()->format('d/m/Y') }} {{ __('at') }} {{ now()->format('H:i') }}
</div>
</body>
</html>
