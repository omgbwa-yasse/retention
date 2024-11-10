<!-- resources/views/public/index.blade.php -->
@extends('index')

@section('content')
    <div class="search-container">
        <div class="hero-section">
            <div class="content-wrapper">
                <h1 class="main-title">Portail africain des délais de conservation</h1>
                <p class="subtitle">Accédez aux informations sur les délais de conservation des documents en Afrique</p>

                <!-- Barre de recherche style Google -->
                <div class="search-wrapper">
                    <form action="{{ route('public.search') }}" method="GET">
                        <div class="search-box">
                            <div class="search-input-wrapper">
                                <i class="fas fa-search search-icon"></i>
                                <input
                                    type="search"
                                    name="q"
                                    class="search-input"
                                    placeholder="Rechercher des classifications, références, règles..."
                                    autocomplete="off"
                                >
                            </div>

                            <div class="search-buttons">
                                <button type="submit" class="search-btn">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="{{ route('public.search') }}" class="advanced-search-btn">
                                    <i class="fas fa-sliders-h"></i>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="icon-decoration">
                    <i class="fas fa-book-reader"></i>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .search-container {
            padding: 2rem 1rem;
        }

        .hero-section {
            background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
            border-radius: 1rem;
            padding: 3rem 1rem;
            color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .content-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }

        .main-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .subtitle {
            font-size: 1.25rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .search-wrapper {
            max-width: 700px;
            margin: 0 auto;
        }

        .search-box {
            background: white;
            border-radius: 100px;
            padding: 0.5rem;
            display: flex;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .search-box:hover,
        .search-box:focus-within {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-1px);
        }

        .search-input-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            padding-left: 1.5rem;
        }

        .search-icon {
            color: #666;
            font-size: 1.1rem;
            margin-right: 1rem;
        }

        .search-input {
            width: 100%;
            padding: 0.8rem;
            border: none;
            font-size: 1.1rem;
            color: #333;
            background: transparent;
        }

        .search-input:focus {
            outline: none;
        }

        .search-buttons {
            display: flex;
            gap: 0.5rem;
            padding-right: 0.5rem;
        }

        .search-btn,
        .advanced-search-btn {
            background: #f8f9fa;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 100px;
            color: #666;
            transition: all 0.2s ease;
        }

        .search-btn:hover,
        .advanced-search-btn:hover {
            background: #e9ecef;
            color: #333;
        }

        .icon-decoration {
            display: none;
        }

        @media (min-width: 992px) {
            .icon-decoration {
                display: block;
                font-size: 6rem;
                opacity: 0.5;
                margin-top: 2rem;
            }

            .hero-section {
                padding: 4rem 2rem;
            }
        }

        .search-input::placeholder {
            color: #6c757d;
            opacity: 0.8;
        }
    </style>
@endpush
