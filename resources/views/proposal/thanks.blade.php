@extends('index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">{{ __('Merci pour votre proposition!') }}</h3>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    </div>
                    <h4>{{ __('Votre proposition a été soumise avec succès.') }}</h4>
                    <p class="mt-3">
                        {{ __('Nous avons bien reçu votre proposition et nous l\'examinerons dans les plus brefs délais.') }}
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('public.index') }}" class="btn btn-primary">
                            <i class="fas fa-home me-2"></i> {{ __('Retour à l\'accueil') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
