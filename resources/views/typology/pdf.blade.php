<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Typologies documentaires</title>
    <style>
        @page {
            margin: 100px 25px;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .header {
            position: fixed;
            top: -60px;
            left: 0;
            right: 0;
            height: 50px;
            background-color: #007bff;
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
            background-color: #007bff;
            color: white;
            text-align: center;
            line-height: 40px;
            font-size: 12px;
        }
        .page-number:after {
            content: counter(page);
        }
        h1 {
            color: #007bff;
            text-align: center;
            margin-top: 20px;
        }
        .typology {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .typology-name {
            font-weight: bold;
            font-size: 16px;
            color: #007bff;
        }
        .typology-description {
            margin-top: 5px;
        }
        .typology-category {
            font-style: italic;
            color: #6c757d;
        }
    </style>
</head>
<body>
<div class="header">
    ICA Retention - Typologies documentaires
</div>

<div class="footer">
    Document généré le {{ date('d/m/Y') }} | Page <span class="page-number"></span>
</div>

<h1>Typologies documentaires</h1>

@foreach ($typologies as $typology)
    <div class="typology">
        <div class="typology-name">{{ $typology->name }}</div>
        <div class="typology-description">{{ $typology->description }}</div>
        <div class="typology-category">Domaine : {{ $typology->category ? $typology->category->name : 'N/A' }}</div>
    </div>
@endforeach
</body>
</html>
