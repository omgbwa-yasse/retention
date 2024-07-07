<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Activités - African Retention Portal</title>
    <style>
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
    ICA Retention - Système de Gestion des Activités
</div>

<div class="footer">
    Document généré le {{ date('d/m/Y') }} | Page <span class="page-number"></span>
</div>

<h1>Liste des Activités</h1>

<table>
    <thead>
    <tr>
        <th>Cote</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Parent</th>
        <th>Sous-classes</th>
        <th>Pays</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($activities as $activity)
        <tr>
            <td>{{ $activity->code }}</td>
            <td>{{ $activity->name }}</td>
            <td>{{ $activity->description }}</td>
            <td>{{ $activity->parent ? $activity->parent->name : '' }}</td>
            <td>{{ $activity->children ? $activity->children->count() : '' }}</td>
            <td>{{ $activity->countries->name }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
