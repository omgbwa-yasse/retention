<!-- resources/views/reference/reference_pdf.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>{{ $reference->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h2, h3, h4, h5, h6 {
            color: #333;
        }
        p {
            margin-bottom: 1em;
        }
        .list-group-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 10px;
        }
        .file-link {
            color: blue;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<h1>{{ $reference->name }}</h1>
<p><strong>Description:</strong> {{ $reference->description }}</p>
<p><strong>Catégorie:</strong> {{ $reference->category->name }}</p>

<h2>Articles associés :</h2>
@if($reference->articles->isEmpty())
    <p>Aucun article associé à cette référence.</p>
@else
    <div class="list-group">
        @foreach($reference->articles as $article)
            <div class="list-group-item">
                <h3>{{ $article->reference }} - {{ $article->name }}</h3>
                <p>{{ $article->description }}</p>
            </div>
        @endforeach
    </div>
@endif

<h2>Fichiers associés</h2>
@if($reference->files->isEmpty())
    <p>Aucun fichier associé à cette référence.</p>
@else
    <div class="list-group">
        @foreach($reference->files as $file)
            <div class="list-group-item">
                <a href="{{ route('reference.file.download', [$reference->id, $file->name]) }}" class="file-link">{{ $file->name }}</a>
            </div>
        @endforeach
    </div>
@endif

<h2>Liens associés</h2>
@if($reference->links->isEmpty())
    <p>Aucun lien associé à cette référence.</p>
@else
    <div class="list-group">
        @foreach($reference->links as $link)
            <div class="list-group-item">
                <a href="http://{{ $link->link }}" class="file-link">{{ $link->name }}</a> ({{ $link->link }})
            </div>
        @endforeach
    </div>
@endif
</body>
</html>
