@extends('layouts.app')
@extends('index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-primary">{{ __('Dashboard') }}</h5>
                        <span class="badge bg-success">En ligne</span>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Stats Overview Cards -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="card bg-primary text-white h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="text-white-50">Total Pays</h6>
                                                <h2 class="mb-0" id="totalCountries">--</h2>
                                            </div>
                                            <i class="fas fa-globe fa-2x text-white-50"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-success text-white h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="text-white-50">Visites Aujourd'hui</h6>
                                                <h2 class="mb-0" id="todayVisits">--</h2>
                                            </div>
                                            <i class="fas fa-users fa-2x text-white-50"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-info text-white h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="text-white-50">Pays Principal</h6>
                                                <h2 class="mb-0" id="topCountry">--</h2>
                                            </div>
                                            <i class="fas fa-star fa-2x text-white-50"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-warning text-white h-100">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="text-white-50">Total Visites</h6>
                                                <h2 class="mb-0" id="totalVisits">--</h2>
                                            </div>
                                            <i class="fas fa-chart-bar fa-2x text-white-50"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Country Stats Card -->
                        <div class="card shadow-sm">
                            <div class="card-header bg-white py-3">
                                <h6 class="mb-0 text-primary">Statistiques par Pays</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                        <tr>
                                            <th>Pays</th>
                                            <th>Drapeau</th>
                                            <th>Nombre de visites</th>
                                            <th>Pourcentage</th>
                                            <th>Dernière visite</th>
                                        </tr>
                                        </thead>
                                        <tbody id="countryStatsBody">
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="visually-hidden">Chargement...</span>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function fetchAndDisplayStats() {
            fetch('{{ route("admin.visitor-stats") }}')
                .then(response => response.json())
                .then(data => {
                    // Update summary cards
                    const totalCountries = new Set(data.map(item => item.country_name)).size;
                    document.getElementById('totalCountries').textContent = totalCountries;

                    const todayVisits = data.reduce((sum, item) =>
                        item.date === new Date().toISOString().split('T')[0] ? sum + item.count : sum, 0);
                    document.getElementById('todayVisits').textContent = todayVisits;

                    const totalVisits = data.reduce((sum, item) => sum + item.count, 0);
                    document.getElementById('totalVisits').textContent = totalVisits;

                    // Group by country and calculate stats
                    const countryStats = {};
                    data.forEach(item => {
                        if (!countryStats[item.country_name]) {
                            countryStats[item.country_name] = {
                                visits: 0,
                                lastVisit: item.date
                            };
                        }
                        countryStats[item.country_name].visits += item.count;
                        countryStats[item.country_name].lastVisit =
                            new Date(item.date) > new Date(countryStats[item.country_name].lastVisit)
                                ? item.date
                                : countryStats[item.country_name].lastVisit;
                    });

                    // Find top country
                    const topCountry = Object.entries(countryStats)
                        .sort((a, b) => b[1].visits - a[1].visits)[0];
                    document.getElementById('topCountry').textContent = topCountry[0];

                    // Update detailed table
                    const tableBody = document.getElementById('countryStatsBody');
                    if (tableBody) {
                        let html = '';
                        Object.entries(countryStats)
                            .sort((a, b) => b[1].visits - a[1].visits)
                            .forEach(([country, stats]) => {
                                const percentage = ((stats.visits / totalVisits) * 100).toFixed(1);
                                html += `
                            <tr>
                                <td>${country}</td>
                                <td><img src="https://flagcdn.com/24x18/${country.toLowerCase()}.png"
                                    alt="${country}" class="border"></td>
                                <td>${stats.visits}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="progress flex-grow-1" style="height: 8px;">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: ${percentage}%"
                                                aria-valuenow="${percentage}"
                                                aria-valuemin="0"
                                                aria-valuemax="100"></div>
                                        </div>
                                        <span class="ms-2">${percentage}%</span>
                                    </div>
                                </td>
                                <td>${new Date(stats.lastVisit).toLocaleDateString('fr-FR', {
                                    day: 'numeric',
                                    month: 'short',
                                    year: 'numeric'
                                })}</td>
                            </tr>`;
                            });
                        tableBody.innerHTML = html;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('countryStatsBody').innerHTML = `
                <tr>
                    <td colspan="5" class="text-center text-danger">
                        <i class="fas fa-exclamation-circle"></i>
                        Erreur lors du chargement des statistiques
                    </td>
                </tr>`;
                });
        }

        // Initialize stats when page loads
        document.addEventListener('DOMContentLoaded', fetchAndDisplayStats);

        // Refresh every 5 minutes
        setInterval(fetchAndDisplayStats, 300000);
    </script>
@endsection
