<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class _05TypologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typologies = [
            [
                'name' => 'Abonnement',
                'description' => 'Document attestant l\'engagement contractuel pour un service récurrent sur une période définie',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Accusé de réception',
                'description' => 'Document confirmant la réception d\'un courrier, d\'un colis ou d\'une demande administrative',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Acte',
                'description' => 'Document officiel constatant un fait, une convention, une obligation',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Acte administratif',
                'description' => 'Document émanant d\'une autorité administrative et créant des droits ou des obligations',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Acte notarié',
                'description' => 'Document authentique rédigé par un notaire dans le cadre de ses fonctions',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Agrément',
                'description' => 'Document officiel attestant une autorisation ou une reconnaissance par une autorité',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Amendement',
                'description' => 'Document proposant une modification à un texte soumis à délibération',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Annexe',
                'description' => 'Document complémentaire joint à un document principal pour l\'enrichir ou le préciser',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Appel d\'offres',
                'description' => 'Document détaillant une procédure de mise en concurrence pour l\'attribution d\'un marché',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Arrêté',
                'description' => 'Décision administrative à portée générale ou individuelle prise par une autorité',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Arrêté ministériel',
                'description' => 'Décision administrative prise par un ministre dans son domaine de compétence',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Arrêté municipal',
                'description' => 'Décision administrative prise par le maire dans le cadre de ses pouvoirs',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Arrêté préfectoral',
                'description' => 'Décision administrative prise par le préfet dans son département',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Attestation',
                'description' => 'Document certifiant un fait, une situation ou un droit',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Autorisation',
                'description' => 'Document accordant officiellement le droit d\'exercer une activité ou une action',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Avenant',
                'description' => 'Document modifiant ou complétant un document contractuel initial',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Avis',
                'description' => 'Document exprimant une opinion ou une recommandation officielle',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Avis de marché',
                'description' => 'Publication officielle annonçant le lancement d\'une procédure de marché public',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Avis de réunion',
                'description' => 'Document informant de la tenue d\'une réunion et de ses modalités',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Bail',
                'description' => 'Contrat de location détaillant les conditions de mise à disposition d\'un bien',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Bon de commande',
                'description' => 'Document formalisant une commande de biens ou services',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Bon de livraison',
                'description' => 'Document attestant de la livraison de biens ou services',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Bordereau',
                'description' => 'Document récapitulatif listant des pièces ou des opérations',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Bordereau d\'envoi',
                'description' => 'Document accompagnant et listant les pièces transmises',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Bordereau de versement',
                'description' => 'Document détaillant les documents versés aux archives',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Budget',
                'description' => 'Document présentant les prévisions de recettes et de dépenses',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Bulletin',
                'description' => 'Publication périodique d\'informations officielles',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Bulletin officiel',
                'description' => 'Publication officielle périodique contenant des actes administratifs',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Cahier des charges',
                'description' => 'Document détaillant les spécifications techniques et les conditions d\'exécution',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Carte',
                'description' => 'Document d\'identification ou de représentation graphique',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Certificat',
                'description' => 'Document officiel attestant un fait, une qualité ou un droit',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Certificat administratif',
                'description' => 'Document certifiant un fait ou une situation administrative',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Charte',
                'description' => 'Document définissant des principes, droits et devoirs fondamentaux',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Circulaire',
                'description' => 'Instruction écrite adressée par une autorité pour l\'application de règles',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Compte-rendu',
                'description' => 'Document relatant le déroulement d\'une réunion ou d\'un événement',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Conclusion',
                'description' => 'Document présentant les points essentiels et recommandations finales',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Conditions générales',
                'description' => 'Document définissant les modalités standard d\'un service ou contrat',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Contrat',
                'description' => 'Convention formelle établissant des engagements entre parties',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Convention',
                'description' => 'Accord écrit entre deux ou plusieurs parties définissant leurs engagements',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Convocation',
                'description' => 'Document appelant à participer à une réunion ou un événement',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Décision',
                'description' => 'Acte administratif individuel exprimant une prise de position officielle',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Déclaration',
                'description' => 'Document officiel par lequel on fait connaître un fait ou une intention',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Décret',
                'description' => 'Acte réglementaire ou individuel pris par le pouvoir exécutif',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Délibération',
                'description' => 'Décision prise collectivement par une assemblée',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Demande',
                'description' => 'Document formulant une requête officielle',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Devis',
                'description' => 'Document détaillant le coût estimatif de travaux ou services',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Directive',
                'description' => 'Instruction officielle définissant des orientations à suivre',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Document technique',
                'description' => 'Document détaillant des spécifications ou procédures techniques',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Dossier d\'appel d\'offres',
                'description' => 'Ensemble des documents nécessaires pour répondre à un appel d\'offres',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'État des lieux',
                'description' => 'Document décrivant la situation ou l\'état d\'un bien à un moment donné',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Étude',
                'description' => 'Document présentant une analyse approfondie d\'un sujet',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Facture',
                'description' => 'Document comptable détaillant les sommes dues pour des biens ou services',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Fiche',
                'description' => 'Document synthétique présentant des informations clés',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Fiche de poste',
                'description' => 'Document décrivant les missions et responsabilités d\'un emploi',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Fiche technique',
                'description' => 'Document présentant les caractéristiques techniques d\'un produit ou service',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Formulaire',
                'description' => 'Document type à remplir pour une démarche administrative',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Guide',
                'description' => 'Document d\'aide et d\'orientation dans une démarche ou procédure',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Instruction',
                'description' => 'Document détaillant des directives ou procédures à suivre',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Inventaire',
                'description' => 'Liste détaillée des biens ou ressources disponibles',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Journal officiel',
                'description' => 'Publication officielle des lois, décrets et actes administratifs',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Lettre',
                'description' => 'Document de correspondance officielle entre services ou personnes',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Lettre recommandée',
                'description' => 'Courrier officiel envoyé avec preuve de réception',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Licence',
                'description' => 'Document autorisant l\'exercice d\'une activité ou l\'utilisation d\'un bien',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Liste',
                'description' => 'Énumération ordonnée d\'éléments ou d\'informations',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Mandat',
                'description' => 'Document officiel conférant un pouvoir ou une mission',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Manuel',
                'description' => 'Guide détaillé d\'utilisation ou de procédures',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Manuel de procédure',
                'description' => 'Document décrivant en détail les processus et méthodes à suivre',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Mémoire',
                'description' => 'Document présentant une analyse détaillée ou une position argumentée',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Note',
                'description' => 'Document bref communiquant une information ou instruction',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Note de service',
                'description' => 'Communication officielle interne donnant des directives ou informations',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Note technique',
                'description' => 'Document détaillant des aspects techniques spécifiques',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Notification',
                'description' => 'Document informant officiellement d\'une décision ou d\'un fait',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Ordre de mission',
                'description' => 'Document officiel autorisant et détaillant une mission professionnelle',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Ordre de service',
                'description' => 'Instruction formelle donnée pour l\'exécution d\'une tâche',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Ordre du jour',
                'description' => 'Liste des points à traiter lors d\'une réunion',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Ordonnance',
                'description' => 'Acte juridique ou administratif émanant d\'une autorité',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Organigramme',
                'description' => 'Représentation graphique de la structure d\'une organisation',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Permis',
                'description' => 'Autorisation officielle d\'exercer une activité réglementée',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Plan',
                'description' => 'Document présentant une organisation spatiale ou temporelle',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Planning',
                'description' => 'Document organisant des activités dans le temps',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Pouvoir',
                'description' => 'Document déléguant une autorité ou capacité d\'action',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Procédure',
                'description' => 'Document décrivant les étapes à suivre pour une opération',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Procès-verbal',
                'description' => 'Document officiel relatant des faits ou décisions',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Procuration',
                'description' => 'Document autorisant une personne à agir au nom d\'une autre',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Programme',
                'description' => 'Document détaillant une suite d\'actions planifiées',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Projet',
                'description' => 'Document présentant une proposition d\'action ou de réalisation',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Protocole',
                'description' => 'Document établissant des règles de procédure ou de comportement',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Rapport',
                'description' => 'Document présentant une analyse ou un compte-rendu détaillé',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Rapport d\'activité',
                'description' => 'Document présentant le bilan des actions sur une période',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Rapport d\'audit',
                'description' => 'Document présentant les conclusions d\'une mission d\'audit',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Rapport d\'évaluation',
                'description' => 'Document analysant les résultats d\'une action ou d\'un programme',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Récépissé',
                'description' => 'Document attestant la réception d\'un document ou d\'un bien',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Réclamation',
                'description' => 'Document exprimant une plainte ou une demande de rectification',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Règlement',
                'description' => 'Document établissant des règles et modalités de fonctionnement',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Règlement intérieur',
                'description' => 'Document fixant les règles de fonctionnement interne',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Relevé de compte',
                'description' => 'Document détaillant les opérations financières sur une période',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Relevé de décisions',
                'description' => 'Document résumant les décisions prises lors d\'une réunion',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Requête',
                'description' => 'Document formulant une demande officielle auprès d\'une autorité',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Résolution',
                'description' => 'Document formalisant une décision prise collectivement',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Statut',
                'description' => 'Document définissant les règles fondamentales d\'une organisation',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Synthèse',
                'description' => 'Document résumant les points essentiels d\'une question ou situation',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Tableau de bord',
                'description' => 'Document présentant des indicateurs de suivi et de performance',
                'category_id' => 1,
                'user_id' => 1
            ],
            [
                'name' => 'Titre',
                'description' => 'Document officiel établissant un droit ou une qualité',
                'category_id' => 1,
                'user_id' => 1
            ]
        ];

        DB::table('typologies')->insert($typologies);
    }
}
