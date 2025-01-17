@extends('index')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">{{ __('who_we_are') }}</h1>
        <div class="card mb-4">
            <div class="card-body">
                <p>{{ __('who_we_are_description') }}</p>
            </div>
        </div>

        <h2 class="mb-4">{{ __('location_presence') }}</h2>
        <div class="card mb-4">
            <div class="card-body">
                <p>{{ __('location_description') }}</p>
            </div>
        </div>

        <h2 class="mb-4">{{ __('organizational_structure') }}</h2>
        <div class="card mb-4">
            <div class="card-body">
                <p>{{ __('organizational_description') }}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>{{ __('presidency') }}:</strong>
                        <ul>
                            <li>{{ __('president') }}: M. KAPET WANDAH JEAN-MARIE</li>
                            <li>{{ __('vice_president') }}: Mme OBE NTOUTOUME ESTELLE épouse ZOGHESSIE</li>
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <strong>{{ __('secretariat') }}:</strong>
                        <ul>
                            <li>{{ __('secretary_general') }}: M. AKA KOFFI AYMAR</li>
                            <li>{{ __('deputy_secretary') }}: M. OMGWA YASSE EMMANUEL FABRICE</li>
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <strong>{{ __('treasury') }}:</strong>
                        <ul>
                            <li>{{ __('treasurer') }}: M. N'DA GUY LANDRY</li>
                            <li>{{ __('deputy_treasurer') }}: M. AGLIKPO HILDEBERT RANDOLPHE</li>
                        </ul>
                    </li>
                </ul>
                <p>{{ __('dual_structure_note') }}</p>
            </div>
        </div>

        <h2 class="mb-4">{{ __('mission_objectives') }}</h2>
        <div class="card mb-4">
            <div class="card-body">
                <p>{{ __('mission_objectives_intro') }}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>{{ __('awareness_advocacy') }}</strong>
                        <p>{{ __('awareness_advocacy_description') }}</p>
                        <ul>
                            <li>{{ __('stakeholder_govts') }}</li>
                            <li>{{ __('stakeholder_communities') }}</li>
                            <li>{{ __('stakeholder_businesses') }}</li>
                            <li>{{ __('stakeholder_households') }}</li>
                        </ul>
                        <p>{{ __('multi_stakeholder_approach') }}</p>
                    </li>
                    <li class="list-group-item">
                        <strong>{{ __('technical_support') }}</strong>
                        <p>{{ __('technical_support_description') }}</p>
                        <ul>
                            <li>{{ __('archiving_project_definition') }}</li>
                            <li>{{ __('archiving_initiative_support') }}</li>
                            <li>{{ __('documentary_heritage_protection') }}</li>
                        </ul>
                        <p>{{ __('technical_services_note') }}</p>
                    </li>
                    <li class="list-group-item">
                        <strong>{{ __('skills_development') }}</strong>
                        <p>{{ __('skills_development_description') }}</p>
                    </li>
                    <li class="list-group-item">
                        <strong>{{ __('gender_equality') }}</strong>
                        <p>{{ __('gender_equality_description') }}</p>
                    </li>
                    <li class="list-group-item">
                        <strong>{{ __('economic_development') }}</strong>
                        <p>{{ __('economic_development_description') }}</p>
                    </li>
                </ul>
            </div>
        </div>

        <h2 class="mb-4">{{ __('recognition_process') }}</h2>
        <div class="card mb-4">
            <div class="card-body">
                <p>{{ __('recognition_process_description') }}</p>
                <ul>
                    <li>{{ __('moral_investigation') }}</li>
                    <li>{{ __('file_examination') }}</li>
                    <li>{{ __('final_approval') }}</li>
                </ul>
            </div>
        </div>

        <h2 class="mb-4">{{ __('impact_future') }}</h2>
        <div class="card mb-4">
            <div class="card-body">
                <p>{{ __('impact_future_intro') }}</p>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>{{ __('heritage_preservation') }}</strong>
                        <ul>
                            <li>{{ __('historical_document_protection') }}</li>
                            <li>{{ __('collective_memory_maintenance') }}</li>
                            <li>{{ __('national_heritage_preservation') }}</li>
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <strong>{{ __('practice_modernization') }}</strong>
                        <ul>
                            <li>{{ __('new_archiving_methods') }}</li>
                            <li>{{ __('modern_technology_training') }}</li>
                            <li>{{ __('practice_standardization') }}</li>
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <strong>{{ __('professional_development') }}</strong>
                        <ul>
                            <li>{{ __('continuous_training') }}</li>
                            <li>{{ __('professional_opportunities') }}</li>
                            <li>{{ __('professional_excellence') }}</li>
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <strong>{{ __('gender_equality') }}</strong>
                        <ul>
                            <li>{{ __('women_sector_encouragement') }}</li>
                            <li>{{ __('female_role_models') }}</li>
                            <li>{{ __('gender_stereotypes_fight') }}</li>
                        </ul>
                    </li>
                    <li class="list-group-item">
                        <strong>{{ __('economic_innovation') }}</strong>
                        <ul>
                            <li>{{ __('archiving_services_development') }}</li>
                            <li>{{ __('specialized_business_creation') }}</li>
                            <li>{{ __('sector_job_creation') }}</li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <h2 class="mb-4">{{ __('strengths') }}</h2>
        <div class="card mb-4">
            <div class="card-body">
                <p>{{ __('strengths_intro') }}</p>
                <ul>
                    <li>{{ __('holistic_approach') }}</li>
                    <li>{{ __('gender_commitment') }}</li>
                    <li>{{ __('entrepreneurial_vision') }}</li>
                    <li>{{ __('professional_structure') }}</li>
                </ul>
            </div>
        </div>

        <h2 class="mb-4">{{ __('challenges_opportunities') }}</h2>
        <div class="card mb-4">
            <div class="card-body">
                <p>{{ __('challenges_opportunities_intro') }}</p>
                <h3>{{ __('challenges') }}:</h3>
                <ul>
                    <li>{{ __('challenge_awareness') }}</li>
                    <li>{{ __('challenge_modernization') }}</li>
                    <li>{{ __('challenge_training') }}</li>
                    <li>{{ __('challenge_resources') }}</li>
                    <li>{{ __('challenge_coordination') }}</li>
                </ul>
                <h3>{{ __('opportunities') }}:</h3>
                <ul>
                    <li>{{ __('opportunity_demand') }}</li>
                    <li>{{ __('opportunity_digital') }}</li>
                    <li>{{ __('opportunity_heritage') }}</li>
                    <li>{{ __('opportunity_employment') }}</li>
                    <li>{{ __('opportunity_collaboration') }}</li>
                </ul>
            </div>
        </div>

        <h2 class="mb-4">{{ __('conclusion') }}</h2>
        <div class="card mb-4">
            <div class="card-body">
                <p>{{ __('conclusion_text') }}</p>
            </div>
        </div>
    </div>
@endsection
