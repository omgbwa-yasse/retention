<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Référence - African Retention Portal</title>
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
            margin-bottom: 30px;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 14px;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .section-content {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
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
        .meta-info {
            font-size: 12px;
            color: #666;
            margin-bottom: 20px;
        }
        .meta-info span {
            margin-right: 20px;
        }
    </style>
</head>
<body>
<div class="header">
    ICA Retention - Système de Gestion des Références
</div>

<div class="footer">
    Document généré le {{ date('d/m/Y') }} | Page <span class="page-number"></span>
</div>

<h1>{{ $reference->name }}</h1>

<div class="meta-info">
    <span><strong>{{ __('category') }}:</strong> {{ $reference->category->name }}</span>
    <span><strong>{{ __('country') }}:</strong> {{ $reference->country->name }}</span>
    <span><strong>{{ __('reference') }}:</strong> {{ $reference->id }}</span>
</div>

<!-- Description -->
<div class="section">
    <div class="section-title">{{ __('description') }}</div>
    <div class="section-content">
        {{ $reference->description }}
    </div>
</div>

<!-- Articles -->
<div class="section">
    <div class="section-title">{{ __('associated_articles') }}</div>
    <table>
        <thead>
        <tr>
            <th>{{ __('article_name') }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($reference->articles as $article)
            <tr>
                <td>
                    <strong>{{ $article->code }}</strong> :
                    <strong>{{ $article->name }}</strong>
                    <em>[ {{ $article->description }} ]</em>
                </td>
            </tr>
        @empty
            <tr>
                <td>{{ __('no_articles') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<!-- Files -->
<div class="section">
    <div class="section-title">{{ __('attached_documents') }}</div>
    <table>
        <thead>
        <tr>
            <th>{{ __('filename') }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse($reference->files as $file)
            <tr>
                <td>{{ $file->name }}</td>
            </tr>
        @empty
            <tr>
                <td>{{ __('no_files') }}</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<!-- Support Message -->
    <div style="margin-top: 30px; text-align: center;  font-size: 15px; color: #666; border-top: 1px solid #ddd; padding-top: 15px;">
        Le projet de Portail africain des délais de conservation des documents administratifs a reçu le soutien de la Commission du Programme du Conseil International des Archives (ICA) 2024
    </div>
</body>
</html>
