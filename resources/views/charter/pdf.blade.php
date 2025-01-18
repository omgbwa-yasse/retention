<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ __('domain_pdf_title') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }};
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        h2 {
            font-size: 20px;
            margin-bottom: 15px;
        }
        p {
            font-size: 16px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: {{ app()->getLocale() === 'ar' ? 'right' : 'left' }};
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="header">
    <h1>{{ $domaine->code }} - {{ $domaine->name }}, ['code' => $domaine->code, 'name' => $domaine->name]) }}</h1>
    <p>{{ $domaine->description }}</p>
</div>

<h2>{{ __('classes_title') }}</h2>
<table>
    <thead>
    <tr>
        <th>{{ __('table_reference') }}</th>
        <th>{{ __('table_title') }}</th>
        <th>{{ __('table_typologies') }}</th>
        <th>{{ __('table_legal_duration') }}</th>
        <th>{{ __('table_legal_trigger') }}</th>
        <th>{{ __('table_references') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($domaine->childrenRecursive as $class)
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
                        @if ($rule->duls)
                            @foreach ($rule->duls as $dul)
                                {{ $dul->duration }}<br>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </td>
            <td>
                @if ($class->rules)
                    @foreach ($class->rules as $rule)
                        @if ($rule->duls)
                            @foreach ($rule->duls as $dul)
                                {{ $dul->trigger->name }}<br>
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
    <p>{{ __('generated_on') }}</p>
</div>
</body>
</html>
