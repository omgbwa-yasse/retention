<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Règles de conservation - ICA Retention</title>
    <style>
        /* Styles similaires à ceux de l'exemple précédent */
        @page {
            margin: 100px 25px;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .header {
            position: fixed;
            top: -60px;
            left: 0;
            right: 0;
            height: 50px;
            background-color: #003366;
            color: white;
            text-align: center;
            line-height: 50px;
        }
        .footer {
            position: fixed;
            bottom: -60px;
            left: 0;
            right: 0;
            height: 30px;
            background-color: #003366;
            color: white;
            text-align: center;
            line-height: 30px;
            font-size: 12px;
        }
        .page-number:after {
            content: counter(page);
        }
        h1 {
            color: #003366;
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #003366;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<div class="header">
    ICA Retention - Règles de conservation
</div>

<div class="footer">
    Document généré le {{ date('d/m/Y') }} | Page <span class="page-number"></span>
</div>

<h1>Liste des Règles de conservation</h1>

<table>
    <thead>
    <tr>
        <th>Code</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Statut</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($rules as $rule)
        <tr>
            <td>{{ $rule->code }}</td>
            <td>{{ $rule->name }}</td>
            <td>{{ $rule->description }}</td>
            <td>{{ $rule->status->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
