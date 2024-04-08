@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Créer une nouvelle référence</div>

                <div class="card-body">
                    <form action="{{ route('reference.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Titre</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Catégorie</label>
                            <select class="form-control" id="category_id" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <hr>

                        <h3>Liens</h3>

                        <div id="links-container">
                            <div class="link-block">
                                <div class="form-group">
                                    <label for="link-title-1">Titre du lien</label>
                                    <input type="text" class="form-control" id="link-title-1" name="links[0][title]">
                                </div>

                                <div class="form-group">
                                    <label for="link-url-1">Lien</label>
                                    <input type="text" class="form-control" id="link-url-1" name="links[0][link]">
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-sm btn-info" id="add-link-button">Ajouter un lien</button>

                        <hr>

                        <h3>Fichiers</h3>

                        <div id="files-container">
                            <div class="file-block">
                                <div class="form-group">
                                    <label for="file-title-1">Titre du fichier</label>
                                    <input type="text" class="form-control" id="file-title-1" name="files[0][title]">
                                </div>

                                <div class="form-group">
                                    <label for="file-input-1">Fichier</label>
                                    <input type="file" class="form-control-file file-input" id="file-input-1" name="files[0][file]">
                                </div>

                                <div class="form-group">
                                    <img id="file-preview-1" src="" style="display: none; max-width: 100px;">
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-sm btn-info" id="add-file-button">Ajouter un fichier</button>

                        <hr>

                        <button type="submit" class="btn btn-primary">Créer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {


        // Fonction pour ajouter un nouveau bloc de lien
        function addLinkBlock() {
            let lastBlockNumber = parseInt($('.link-block').last().attr('id').split('-')[1]);
            let newBlockNumber = lastBlockNumber + 1;

            let newBlockHtml = `
                <div class="link-block" id="link-block-${newBlockNumber}">
                    <div class="form-group">
                        <label for="link-title-${newBlockNumber}">Titre du lien</label>
                        <input type="text" class="form-control" id="link-title-${newBlockNumber}" name="links[${newBlockNumber}][title]" required>
                    </div>

                    <div class="form-group">
                        <label for="link-url-${newBlockNumber}">Lien</label>
                        <input type="text" class="form-control" id="link-url-${newBlockNumber}" name="links[${newBlockNumber}][link]" required>
                    </div>

                    <button type="button" class="btn btn-sm btn-danger" onclick="removeLinkBlock(${newBlockNumber})">Supprimer</button>
                </div>
            `;

            $('#links-container').append(newBlockHtml);
        }



        // Fonction pour ajouter un nouveau bloc de fichier
        function addFileBlock() {
            let lastBlockNumber = parseInt($('.file-block').last().attr('id').split('-')[1]);
            let newBlockNumber = lastBlockNumber + 1;

            let newBlockHtml = `
                <div class="file-block" id="file-block-${newBlockNumber}">
                    <div class="form-group">
                        <label for="file-title-${newBlockNumber}">Titre du fichier</label>
                        <input type="text" class="form-control" id="file-title-${newBlockNumber}" name="files[${newBlockNumber}][title]" required>
                    </div>

                    <div class="form-group">
                        <label for="file-input-${newBlockNumber}">Fichier</label>
                        <input type="file" class="form-control-file file-input" id="file-input-${newBlockNumber}" name="files[${newBlockNumber}][file]" required>
                    </div>

                    <div class="form-group">
                        <img id="file-preview-${newBlockNumber}" src="" style="display: none; max-width: 100px;">
                    </div>

                    <button type="button" class="btn btn-sm btn-danger" onclick="removeFileBlock(${newBlockNumber})">Supprimer</button>
                </div>
            `;

            $('#files-container').append(newBlockHtml);
        }



        // Bouton pour ajouter un lien
        $('#add-link-button').click(function() {
            addLinkBlock();
        });



        // Bouton pour ajouter un fichier
        $('#add-file-button').click(function() {
            addFileBlock();
        });


        // Fonction pour supprimer un bloc de lien
        function removeLinkBlock(blockNumber) {
            $('#link-block-' + blockNumber).remove();
        }

        // Fonction pour supprimer un bloc de fichier
        function removeFileBlock(blockNumber) {
            $('#file-block-' + blockNumber).remove();
        }

        // Aperçu du fichier
        $(document).on('change', '.file-input', function() {
            let blockNumber = $(this).attr('id').split('-')[2];
            let file = $(this)[0].files[0];

            if (file) {
                let reader = new FileReader();

                reader.onload = function() {
                    $('#file-preview-' + blockNumber).attr('src', reader.result);
                    $('#file-preview-' + blockNumber).show();
                };

                reader.readAsDataURL(file);
            }
        });
    });

</script>
@endsection
