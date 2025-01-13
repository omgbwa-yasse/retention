<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <!-- Bootstrap CSS -->
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>--}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<style>
    .committee-wrapper {
        padding: 1rem;
        background-color: #f8fafc;
        min-height: 100vh;
    }

    .committee-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        overflow: hidden;
    }

    .committee-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .header-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1a1f36;
    }

    .header-actions {
        display: flex;
        gap: 0.5rem;
    }

    .compact-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .compact-table th {
        background: #fafbfc;
        padding: 0.75rem 1rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid #f0f0f0;
    }

    .compact-table td {
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        border-bottom: 1px solid #f0f0f0;
        background: white;
    }

    .compact-table tr:hover td {
        background: #f8fafc;
    }

    .status-badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .status-waiting {
        background: #f1f5f9;
        color: #475569;
    }

    .status-accepted {
        background: #e0f2fe;
        color: #0369a1;
    }

    .status-valid {
        background: #dcfce7;
        color: #166534;
    }

    .status-rejected {
        background: #fee2e2;
        color: #991b1b;
    }

    .validator-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.25rem 0.5rem;
        background: #f8fafc;
        border-radius: 6px;
        font-size: 0.85rem;
    }

    .validator-avatar {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #e2e8f0;
        flex-shrink: 0;
    }

    .action-btn {
        padding: 0.35rem 0.75rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-accept {
        background: #dcfce7;
        color: #166534;
    }

    .btn-accept:hover {
        background: #bbf7d0;
    }

    .btn-reject {
        background: #fee2e2;
        color: #991b1b;
    }

    .btn-reject:hover {
        background: #fecaca;
    }

    .empty-state {
        padding: 3rem;
        text-align: center;
        color: #64748b;
    }

    .alert {
        margin-bottom: 1rem;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-size: 0.9rem;
    }

    .alert-success {
        background: #dcfce7;
        color: #166534;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
    }
</style>

