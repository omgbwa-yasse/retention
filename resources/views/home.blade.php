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
        function getCountryCode(countryName) {
            const countryCodes = {
                'Afghanistan': 'af', 'Albania': 'al', 'Algeria': 'dz', 'Andorra': 'ad', 'Angola': 'ao',
                'Argentina': 'ar', 'Armenia': 'am', 'Australia': 'au', 'Austria': 'at', 'Azerbaijan': 'az',
                'Bahamas': 'bs', 'Bahrain': 'bh', 'Bangladesh': 'bd', 'Barbados': 'bb', 'Belarus': 'by',
                'Belgium': 'be', 'Belize': 'bz', 'Benin': 'bj', 'Bhutan': 'bt', 'Bolivia': 'bo',
                'Bosnia and Herzegovina': 'ba', 'Botswana': 'bw', 'Brazil': 'br', 'Brunei': 'bn',
                'Bulgaria': 'bg', 'Burkina Faso': 'bf', 'Burundi': 'bi', 'Cambodia': 'kh',
                'Cameroon': 'cm', 'Canada': 'ca', 'Cape Verde': 'cv', 'Central African Republic': 'cf',
                'Chad': 'td', 'Chile': 'cl', 'China': 'cn', 'Colombia': 'co', 'Comoros': 'km',
                'Congo': 'cg', 'Costa Rica': 'cr', 'Croatia': 'hr', 'Cuba': 'cu', 'Cyprus': 'cy',
                'Czech Republic': 'cz', 'Denmark': 'dk', 'Djibouti': 'dj', 'Dominica': 'dm',
                'Dominican Republic': 'do', 'Ecuador': 'ec', 'Egypt': 'eg', 'El Salvador': 'sv',
                'Equatorial Guinea': 'gq', 'Eritrea': 'er', 'Estonia': 'ee', 'Ethiopia': 'et',
                'Fiji': 'fj', 'Finland': 'fi', 'France': 'fr', 'Gabon': 'ga', 'Gambia': 'gm',
                'Georgia': 'ge', 'Germany': 'de', 'Ghana': 'gh', 'Greece': 'gr', 'Grenada': 'gd',
                'Guatemala': 'gt', 'Guinea': 'gn', 'Guinea-Bissau': 'gw', 'Guyana': 'gy', 'Haiti': 'ht',
                'Honduras': 'hn', 'Hungary': 'hu', 'Iceland': 'is', 'India': 'in', 'Indonesia': 'id',
                'Iran': 'ir', 'Iraq': 'iq', 'Ireland': 'ie', 'Israel': 'il', 'Italy': 'it',
                'Ivory Coast': 'ci', "Côte d'Ivoire": 'ci', 'Jamaica': 'jm', 'Japan': 'jp', 'Jordan': 'jo',
                'Kazakhstan': 'kz', 'Kenya': 'ke', 'Kiribati': 'ki', 'North Korea': 'kp',
                'South Korea': 'kr', 'Kuwait': 'kw', 'Kyrgyzstan': 'kg', 'Laos': 'la', 'Latvia': 'lv',
                'Lebanon': 'lb', 'Lesotho': 'ls', 'Liberia': 'lr', 'Libya': 'ly', 'Liechtenstein': 'li',
                'Lithuania': 'lt', 'Luxembourg': 'lu', 'Madagascar': 'mg', 'Malawi': 'mw',
                'Malaysia': 'my', 'Maldives': 'mv', 'Mali': 'ml', 'Malta': 'mt', 'Mauritania': 'mr',
                'Mauritius': 'mu', 'Mexico': 'mx', 'Moldova': 'md', 'Monaco': 'mc', 'Mongolia': 'mn',
                'Montenegro': 'me', 'Morocco': 'ma', 'Mozambique': 'mz', 'Myanmar': 'mm',
                'Namibia': 'na', 'Nauru': 'nr', 'Nepal': 'np', 'Netherlands': 'nl', 'New Zealand': 'nz', 'Nicaragua': 'ni',
                'Niger': 'ne', 'Nigeria': 'ng', 'Norway': 'no', 'Oman': 'om', 'Pakistan': 'pk',
                'Palau': 'pw', 'Palestine': 'ps', 'Panama': 'pa', 'Papua New Guinea': 'pg',
                'Paraguay': 'py', 'Peru': 'pe', 'Philippines': 'ph', 'Poland': 'pl', 'Portugal': 'pt',
                'Qatar': 'qa', 'Romania': 'ro', 'Russia': 'ru', 'Rwanda': 'rw', 'Saint Kitts and Nevis': 'kn',
                'Saint Lucia': 'lc', 'Saint Vincent': 'vc', 'Samoa': 'ws', 'San Marino': 'sm',
                'Sao Tome and Principe': 'st', 'Saudi Arabia': 'sa', 'Senegal': 'sn', 'Serbia': 'rs',
                'Seychelles': 'sc', 'Sierra Leone': 'sl', 'Singapore': 'sg', 'Slovakia': 'sk',
                'Slovenia': 'si', 'Solomon Islands': 'sb', 'Somalia': 'so', 'South Africa': 'za',
                'South Sudan': 'ss', 'Spain': 'es', 'Sri Lanka': 'lk', 'Sudan': 'sd', 'Suriname': 'sr',
                'Swaziland': 'sz', 'Sweden': 'se', 'Switzerland': 'ch', 'Syria': 'sy', 'Taiwan': 'tw',
                'Tajikistan': 'tj', 'Tanzania': 'tz', 'Thailand': 'th', 'Togo': 'tg', 'Tonga': 'to',
                'Trinidad and Tobago': 'tt', 'Tunisia': 'tn', 'Turkey': 'tr', 'Turkmenistan': 'tm',
                'Tuvalu': 'tv', 'Uganda': 'ug', 'Ukraine': 'ua', 'United Arab Emirates': 'ae',
                'United Kingdom': 'gb', 'United States': 'us', 'Uruguay': 'uy', 'Uzbekistan': 'uz',
                'Vanuatu': 'vu', 'Vatican City': 'va', 'Venezuela': 've', 'Vietnam': 'vn',
                'Yemen': 'ye', 'Zambia': 'zm', 'Zimbabwe': 'zw',
                'Unknown': 'xx', 'Non Identified': 'xx'
            };
            return countryCodes[countryName] || 'xx';
        }

        function fetchAndDisplayStats() {
            fetch('{{ route("admin.visitor-stats") }}')
                .then(response => response.json())
                .then(data => {
                    // Update summary cards
                    const totalCountries = new Set(data.filter(item =>
                        item.country_name !== 'Unknown' &&
                        item.country_name !== 'Non Identified'
                    ).map(item => item.country_name)).size;

                    document.getElementById('totalCountries').textContent = totalCountries;

                    const today = new Date().toISOString().split('T')[0];
                    const todayVisits = data.reduce((sum, item) =>
                        item.date === today ? sum + item.count : sum, 0);
                    document.getElementById('todayVisits').textContent = todayVisits;

                    const totalVisits = data.reduce((sum, item) => sum + item.count, 0);
                    document.getElementById('totalVisits').textContent = totalVisits;

                    // Group by country and calculate stats
                    const countryStats = {};
                    data.forEach(item => {
                        if (!countryStats[item.country_name]) {
                            countryStats[item.country_name] = {
                                visits: 0,
                                lastVisit: item.date,
                                countryCode: item.country_code || getCountryCode(item.country_name)
                            };
                        }
                        countryStats[item.country_name].visits += item.count;
                        countryStats[item.country_name].lastVisit =
                            new Date(item.date) > new Date(countryStats[item.country_name].lastVisit)
                                ? item.date
                                : countryStats[item.country_name].lastVisit;
                    });

                    // Find top country (excluding Unknown and Non Identified)
                    const topCountry = Object.entries(countryStats)
                        .filter(([name]) => name !== 'Unknown' && name !== 'Non Identified')
                        .sort((a, b) => b[1].visits - a[1].visits)[0];
                    document.getElementById('topCountry').textContent = topCountry ? topCountry[0] : '--';

                    // Update detailed table
                    const tableBody = document.getElementById('countryStatsBody');
                    if (tableBody) {
                        let html = '';
                        Object.entries(countryStats)
                            .sort((a, b) => b[1].visits - a[1].visits)
                            .forEach(([country, stats]) => {
                                const percentage = ((stats.visits / totalVisits) * 100).toFixed(1);
                                const countryCode = stats.countryCode.toLowerCase();
                                const flagHtml = countryCode !== 'xx'
                                    ? `<img src="https://flagcdn.com/24x18/${countryCode}.png"
                                           alt="${country}" class="border"
                                           onerror="this.src='https://flagcdn.com/24x18/xx.png'">`
                                    : '<span class="text-muted">--</span>';

                                html += `
                                    <tr>
                                        <td>${country}</td>
                                        <td>${flagHtml}</td>
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
