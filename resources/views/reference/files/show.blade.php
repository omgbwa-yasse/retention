@extends('index')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="card-title mb-4">{{ $file->name }}</h1>
                <div class="mb-3">
                    <a href="{{ route('reference.file.download', [$reference, $file->name]) }}" class="btn btn-primary me-2">
                        <i class="bi bi-download"></i> Download File
                    </a>
                    <a href="{{ route('reference.file.edit', [$reference, $file]) }}" class="btn btn-secondary me-2">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <form action="{{ route('reference.file.destroy', [$reference, $file]) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </form>
                </div>

                <div id="pdf-controls" class="mb-3 d-flex align-items-center" style="display: none;">

                    <div class="input-group" style="width: auto;">

                    </div>

                </div>

                <div id="pdf-container" class="border rounded" style="height: 600px; overflow: auto; display: none;">
                    <iframe id="pdf-iframe" src="" style="width: 100%; height: 100%; border: none;"></iframe>
                </div>
                <div id="preview-unavailable" class="alert alert-warning" role="alert" style="display: none;">
                    Aperçu non disponible
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filePath = '{{ $file->file_path }}';
            const fileExtension = filePath.split('.').pop().toLowerCase();

            if (fileExtension !== 'pdf') {
                document.getElementById('preview-unavailable').style.display = 'block';
                return;
            }

            const url = '{{ route('reference.file.preview', [$reference, $file->name]) }}';
            const container = document.getElementById('pdf-container');
            const iframe = document.getElementById('pdf-iframe');
            const prevPageButton = document.getElementById('prev-page');
            const nextPageButton = document.getElementById('next-page');
            const pageNumberInput = document.getElementById('page-number');
            const totalPagesSpan = document.getElementById('total-pages');
            const pdfControls = document.getElementById('pdf-controls');

            container.style.display = 'block';
            pdfControls.style.display = 'flex';

            iframe.src = url;

            iframe.onload = function() {
                const pdfDoc = iframe.contentWindow.document;
                totalPagesSpan.textContent = pdfDoc.querySelectorAll('.page').length;
            };

            prevPageButton.addEventListener('click', function() {
                const currentPage = parseInt(pageNumberInput.value);
                if (currentPage > 1) {
                    pageNumberInput.value = currentPage - 1;
                    navigateToPage(currentPage - 1);
                }
            });

            nextPageButton.addEventListener('click', function() {
                const currentPage = parseInt(pageNumberInput.value);
                const totalPages = parseInt(totalPagesSpan.textContent);
                if (currentPage < totalPages) {
                    pageNumberInput.value = currentPage + 1;
                    navigateToPage(currentPage + 1);
                }
            });

            pageNumberInput.addEventListener('change', function() {
                const pageNum = parseInt(this.value);
                const totalPages = parseInt(totalPagesSpan.textContent);
                if (pageNum > 0 && pageNum <= totalPages) {
                    navigateToPage(pageNum);
                }
            });

            function navigateToPage(pageNum) {
                iframe.contentWindow.postMessage({ type: 'navigate', page: pageNum }, '*');
            }
        });
    </script>
@endsection
