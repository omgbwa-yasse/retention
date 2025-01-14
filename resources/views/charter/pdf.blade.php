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
    <h1>{{ $mission->code }} - {{ $mission->name }}</h1>
    <p>{{ $mission->description }}</p>
</div>

<h2>Classes</h2>
<table>
    <thead>
    <tr>
        <th>Cote</th>
        <th>Intitulé</th>
        <th>Typologies</th>

        <th>Durée légale Délai</th>
        <th>Durée légale Déclencheur</th>
        <th>Références</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($mission->childrenRecursive as $activity)
        <tr>
            <td>{{ $activity->code }}</td>
            <td>{{ $activity->name }}</td>
            <td>
                @if ($activity->typologies)
                    @foreach ($activity->typologies as $typology)
                        {{ $typology->name }}<br>
                    @endforeach
                @endif
            </td>
            <td>
                @if ($activity->rules)
                    @foreach ($activity->rules as $rule)
                        @if ($rule->duls)
                            @foreach ($rule->duls as $dul)
                                {{ $dul->duration }}<br>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </td>
            <td>
                @if ($activity->rules)
                    @foreach ($activity->rules as $rule)
                        @if ($rule->duls)
                            @foreach ($rule->duls as $dul)
                                {{ $dul->trigger->name }}<br>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </td>
            <td>
                @if ($activity->rules)
                    @foreach ($activity->rules as $rule)
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
