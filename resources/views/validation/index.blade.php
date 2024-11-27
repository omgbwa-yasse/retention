@extends('index')


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


@section('content')
    <div class="committee-wrapper">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div class="committee-card">
            <div class="committee-header">
                <h2 class="header-title">Règles de committee</h2>
                <div class="header-actions">
                <span class="validator-chip">
                    <span>Total: {{ count($rules) }} règles</span>
                </span>
                </div>
            </div>

            <div class="table-responsive">
                <table class="compact-table">
                    <thead>
                    <tr>
                        <th style="width: 60px">ID</th>
                        <th>Nom</th>
                        <th style="width: 120px">Statut</th>
                        <th>Validé par</th>
                        <th style="width: 140px">Date</th>
                        <th style="width: 180px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($rules as $rule)
                        <tr>
                            <td class="text-muted">#{{ $rule->id }}</td>
                            <td>{{ $rule->name }}</td>
                            <td>
                                @php
                                    $statusClass = match($rule->status_id) {
                                        1 => 'status-waiting',
                                        2 => 'status-accepted',
                                        3 => 'status-valid',
                                        4 => 'status-rejected',
                                        default => 'status-waiting'
                                    };

                                    $statusText = match($rule->status_id) {
                                        1 => 'En attente',
                                        2 => 'Acceptée',
                                        3 => 'Valide',
                                        4 => 'Rejeté',
                                        default => 'En attente'
                                    };
                                @endphp
                                <span class="status-badge {{ $statusClass }}">{{ $statusText }}</span>
                            </td>
                            <td>
                                @if($rule->validator)
                                    <div class="validator-chip">
                                        <div class="validator-avatar"></div>
                                        <span>{{ $rule->validator->name }}</span>
                                    </div>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($rule->validated_at)
                                    <span title="{{ $rule->validated_at }}">
                                        {{ \Carbon\Carbon::parse($rule->validated_at)->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($rule->status_id == 1)
                                    <form action="{{ route('committee.update', $rule->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_id" value="2">
                                        <button type="submit" class="action-btn btn-accept" onclick="return confirm('Confirmer l\'acceptation ?')">
                                            Accepter
                                        </button>
                                    </form>
                                    <form action="{{ route('committee.update', $rule->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status_id" value="4">
                                        <button type="submit" class="action-btn btn-reject" onclick="return confirm('Confirmer le rejet ?')">
                                            Rejeter
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    Aucune règle trouvée
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
