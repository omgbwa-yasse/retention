<form action="{{ route('ressource.store', $reference->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>

    <div class="form-group">
        <label for="link">Lien</label>
        <input type="text" name="link" class="form-control">
    </div>

    <div class="form-group">
        <label for="file_path">Fichier</label>
        <input type="file" name="file_path" class="form-control-file" required>
    </div>

    <div class="form-group">
        <label for="reference_id">Référence</label>
        <select name="reference_id" class="form-control" disabled>
            <option value="{{ $reference->id }}">{{ $reference->title }}</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Créer</button>
</form>
