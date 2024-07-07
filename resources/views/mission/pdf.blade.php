<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Missions - {{ $country->name }} ({{ $country->abbr }})</title>
    <style>
        @page {
            margin: 100px 25px;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .header {
            position: fixed;
            top: -60px;
            left: 0;
            right: 0;
            height: 50px;
            background-color: #2c3e50;
            color: white;
            text-align: center;
            line-height: 50px;
        }
        .footer {
            position: fixed;
            bottom: -60px;
            left: 0;
            right: 0;
            height: 40px;
            background-color: #2c3e50;
            color: white;
            text-align: center;
            line-height: 40px;
            font-size: 12px;
        }
        .page-number:after {
            content: counter(page);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-top: 20px;
        }
        .mission {
            margin-bottom: 10px;
        }
        .mission-header {
            font-weight: bold;
            background-color: #ecf0f1;
            padding: 5px;
        }
        .subclass {
            margin-left: 20px;
        }
        .subclass-header {
            font-weight: bold;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
<div class="header">
    ICA Retention - Système de Gestion des Missions
</div>

<div class="footer">
    {{ $country->name }} ({{ $country->abbr }}) | Document généré le {{ date('d/m/Y') }} | Page <span class="page-number"></span>
</div>

<h1>Missions - {{ $country->name }} ({{ $country->abbr }})</h1>

@foreach ($items as $item)
    <div class="mission">
        <div class="mission-header">{{ $item->code }}: {{ $item->name }}</div>
        @if ($item->children->isNotEmpty())
            @include('mission.pdf_subclasses', ['subclasses' => $item->children])
        @endif
    </div>
    @if (!$loop->last)
        <div class="page-break"></div>
    @endif
@endforeach
</body>
</html>
