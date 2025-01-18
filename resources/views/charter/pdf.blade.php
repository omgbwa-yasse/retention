<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('domain_pdf_title') }}</title>
    <!-- Bootstrap CSS -->
    <style>
        :root {
            --bs-primary: #0d6efd;
            --bs-border-color: #418a41;
        }

        body {
    
            direction: {{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }};
            font-size: 14px;
            line-height: 1.5;
        }

        /* Print-specific styles */
        @media print {
            body {
                margin: 0;
                padding: 15px;
            }

            .container {
                max-width: none;
                width: 100%;
                padding: 0;
            }
        }

        .class-indent {
            display: inline-block;
            width: 1rem;
            margin-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}: 0.5rem;
            border-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }}: 2px solid var(--bs-primary);
            opacity: 0.5;
        }

        .class-code {
            font-family: var(--bs-font-monospace);
            color: var(--bs-primary);
            font-weight: 500;
        }

        .rule-duration {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: var(--bs-border-radius-sm);
            background-color: var(--bs-gray-100);
        }

        .table > :not(caption) > * > * {
            padding: 0.5rem;
        }

        .rule-info {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .rule-info li {
            margin-bottom: 0.25rem;
        }

        .table > tbody > tr.class-parent {
            background-color: var(--bs-gray-100);
        }

        .page-break {
            page-break-after: always;
        }

        @page {
            margin: 1.5cm;
        }
    </style>
</head>
<body>
<div class="container">
    <header class="border-bottom pb-3 mb-4">
        <h1 class="h3 mb-2">{{ $domaine->code }} - {{ $domaine->name }}</h1>
        @if($domaine->description)
            <p class="text-secondary mb-0">{{ $domaine->description }}</p>
        @endif
    </header>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
            <tr>
                <th style="width: 15%">{{ __('table_code') }}</th>
                <th style="width: 25%">{{ __('table_title') }}</th>
                <th style="width: 30%">{{ __('table_legal_duration') }}</th>
                <th style="width: 30%">{{ __('table_references') }}</th>
            </tr>
            </thead>
            <tbody>
            @php
                function renderClasses($classes, $level = 0) {
                    foreach ($classes as $class) {
                        $isParent = $class->children->isNotEmpty();
                        echo '<tr class="'.($isParent ? 'class-parent' : '').'">';

                        // Code column with indentation
                        echo '<td class="text-nowrap">';
                        if ($level > 0) {
                            for ($i = 0; $i < $level; $i++) {
                                echo '<span class="class-indent"></span>';
                            }
                        }
                        echo '<span class="class-code">'.$class->code.'</span>';
                        echo '</td>';

                        // Name column
                        echo '<td>'.$class->name.'</td>';

                        // Legal duration column
                        echo '<td>';
                        if($class->rules && $class->rules->isNotEmpty()) {
                            echo '<ul class="rule-info">';
                            foreach ($class->rules as $rule) {
                                echo '<li class="d-flex align-items-center gap-2">';
                                echo '<span class="class-code">'.$rule->code.'</span>';
                                echo '<span>'.$rule->name.'</span>';
                                echo '<span class="rule-duration">'.$rule->duration.'</span>';
                                echo '</li>';
                            }
                            echo '</ul>';
                        }
                        echo '</td>';

                        // References column
                        echo '<td>';
                        if($class->rules && $class->rules->isNotEmpty()) {
                            echo '<ul class="rule-info">';
                            foreach ($class->rules as $rule) {
                                if($rule->articles) {
                                    foreach ($rule->articles as $article) {
                                        echo '<li class="d-flex align-items-center gap-2">';
                                        echo '<span class="class-code">'.$article->code.'</span>';
                                        echo '<span>'.$article->name.'</span>';
                                        echo '</li>';
                                    }
                                }
                            }
                            echo '</ul>';
                        }
                        echo '</td>';
                        echo '</tr>';

                        if ($isParent) {
                            renderClasses($class->children, $level + 1);
                        }
                    }
                }
            @endphp

            @php renderClasses($domaine->children); @endphp
            </tbody>
        </table>
    </div>

    <footer class="border-top pt-3 mt-4 text-secondary small">
        <p class="mb-0">{{ __('generated_on') }} {{ now()->format('d/m/Y H:i') }}</p>
    </footer>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
