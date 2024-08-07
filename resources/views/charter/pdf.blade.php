<!DOCTYPE html>
<html>
<head>
    <title>Domaine PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
            text-align: left;
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
    <h1>{{ $domaine->code }} - {{ $domaine->name }}</h1>
    <p>{{ $domaine->description }}</p>
</div>

<h2>Classes</h2>
<table>
    <thead>
    <tr>
        <th>Cote</th>
        <th>Intitulé</th>
        <th>Typologies</th>
        <th>Active Délai</th>
        <th>Active Déclencheur</th>
        <th>Semi-active Délai</th>
        <th>Semi-active Déclencheur</th>
        <th>Durée légale Délai</th>
        <th>Durée légale Déclencheur</th>
        <th>Références</th>
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
                        @if ($rule->duas)
                            @foreach ($rule->duas as $dua)
                                {{ $dua->duration }}<br>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </td>
            <td>
                @if ($class->rules)
                    @foreach ($class->rules as $rule)
                        @if ($rule->duas)
                            @foreach ($rule->duas as $dua)
                                {{ $dua->trigger->name }}<br>
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
    <p>Généré le {{ now()->format('d/m/Y H:i:s') }}</p>
</div>
</body>
</html>
