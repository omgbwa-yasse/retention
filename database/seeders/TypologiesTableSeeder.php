<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class TypologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typologies = [
            'Abandon', 'Abonnement', 'Absence', 'Acceptation', 'Accès', 'Accident', 'Accompagnement', 'Accord',
            'Accréditation', 'Accusé de réception', 'Acquisition', 'Acte', 'Action', 'Activité', 'Actualisation',
            'Adhésion', 'Administration', 'Admission', 'Adoption', 'Adresse', 'Affaire', 'Affectation', 'Affichage',
            'Agrément', 'Aide', 'Ajournement', 'Alerte', 'Allocation', 'Alternance', 'Amendement', 'Amplitude',
            'Analyse', 'Annexe', 'Annonce', 'Annulation', 'Application', 'Appréciation', 'Approbation',
            'Approvisionnement', 'Archive', 'Arrêté', 'Article', 'Assemblée', 'Assignation', 'Assistance',
            'Association', 'Assurance', 'Attestation', 'Audit', 'Authentification', 'Autorisation', 'Avancement',
            'Avantage', 'Avenant', 'Avertissement', 'Avis', 'Balance', 'Bâtiment', 'Bénéfice', 'Bénéficiaire',
            'Besoin', 'Bibliothèque', 'Bilan', 'Blocage', 'Bon de commande', 'Bon de livraison', 'Bon pour accord',
            'Bordereau', 'Budget', 'Bulletin', 'Cabinet', 'Cadre', 'Caisse', 'Calcul', 'Calendrier', 'Candidature',
            'Capacité', 'Capital', 'Carrière', 'Carte', 'Cas', 'Catalogue', 'Catégorie', 'Caution', 'Centre',
            'Certificat', 'Certification', 'Cession', 'Chambre', 'Changement', 'Chapitre', 'Charge', 'Charte',
            'Classement', 'Client', 'Clôture', 'Code', 'Codification', 'Collection', 'Comité', 'Commande',
            'Commission', 'Communication', 'Compétence', 'Complément', 'Composition', 'Compte', 'Compte-rendu',
            'Concession', 'Concours', 'Conditions', 'Conférence', 'Confirmation', 'Conforme', 'Conservation',
            'Consultation', 'Contentieux', 'Contrat', 'Contrôle', 'Convention', 'Convocation', 'Coopération',
            'Coordination', 'Copie', 'Correspondance', 'Cotisation', 'Créance', 'Crédit', 'Critère', 'Décès',
            'Décharge', 'Décision', 'Déclaration', 'Décompte', 'Décret', 'Défaut', 'Défense', 'Délai', 'Délégation',
            'Délibération', 'Demande', 'Démission', 'Département', 'Dépense', 'Déplacement', 'Dépôt', 'Désignation',
            'Destination', 'Détachement', 'Détail', 'Développement', 'Devis', 'Diagnostic', 'Diffusion', 'Direction',
            'Discipline', 'Dispense', 'Disposition', 'Document', 'Domaine', 'Dommage', 'Donnée', 'Dossier',
            'Dotation', 'Douane', 'Droit', 'Duplicata', 'Échange', 'Échéance', 'École', 'Économie', 'Écriture',
            'Édition', 'Éducation', 'Effet', 'Élection', 'Élément', 'Émission', 'Emploi', 'Employé', 'Emprunt',
            'Encaissement', 'Engagement', 'Enquête', 'Enregistrement', 'Enseignement', 'Entreprise', 'Entretien',
            'Environnement', 'Équipement', 'Établissement', 'État', 'Évaluation', 'Événement', 'Examen', 'Exception',
            'Exercice', 'Expédition', 'Expert', 'Expertise', 'Expiration', 'Exploitation', 'Export', 'Expression',
            'Extension', 'Extrait', 'Fabrication', 'Facture', 'Famille', 'Feuille', 'Fiche', 'Fichier', 'Finance',
            'Fiscalité', 'Fixation', 'Fonction', 'Fondation', 'Formation', 'Formulaire', 'Fournisseur', 'Frais',
            'Franchise', 'Fréquence', 'Garantie', 'Garde', 'Gestion', 'Grade', 'Graphique', 'Gratification', 'Grille',
            'Groupe', 'Groupement', 'Guide', 'Habitation', 'Heures', 'Historique', 'Homologation', 'Honoraire',
            'Horaire', 'Hospitalisation', 'Hygiène', 'Identification', 'Identité', 'Image', 'Immatriculation',
            'Immigration', 'Immobilisation', 'Impact', 'Impôt', 'Imprimé', 'Incident', 'Indemnité', 'Index',
            'Indication', 'Indicateur', 'Information', 'Infraction', 'Initiative', 'Inscription', 'Inspection',
            'Installation', 'Instance', 'Institut', 'Instruction', 'Instrument', 'Intégration', 'Intérêt',
            'Intervention', 'Inventaire', 'Invitation', 'Journal', 'Journée', 'Jugement', 'Juridiction', 'Justice',
            'Justificatif', 'Laboratoire', 'Législation', 'Lettre', 'Liaison', 'Libellé', 'Liberté', 'Licence',
            'Limitation', 'Liste', 'Littéral', 'Livraison', 'Livre', 'Local', 'Localisation', 'Logement', 'Logiciel',
            'Logistique', 'Machine', 'Magistrat', 'Maintenance', 'Mairie', 'Mandat', 'Manuel', 'Manuscrit', 'Marché',
            'Marge', 'Matériel', 'Médical', 'Membre', 'Mémoire', 'Message', 'Mesure', 'Méthode', 'Mission',
            'Modification', 'Module', 'Montant', 'Moyenne', 'Mutation', 'National', 'Nature', 'Navigation', 'Niveau',
            'Nomenclature', 'Nomination', 'Norme', 'Note', 'Notice', 'Notification', 'Numéral', 'Numéro', 'Objectif',
            'Obligation', 'Observation', 'Occupation', 'Opération', 'Opposition', 'Option', 'Oral', 'Ordonnance',
            'Ordre', 'Organisation', 'Orientation', 'Original', 'Ouverture', 'Ouvrage', 'Page', 'Paiement', 'Paramètre',
            'Parcours', 'Partage', 'Participation', 'Particulier', 'Passage', 'Patrimoine', 'Pénalité', 'Pension',
            'Performance', 'Période', 'Permission', 'Personnel', 'Phase', 'Pièce', 'Planning', 'Police', 'Politique',
            'Population', 'Position', 'Poste', 'Pouvoir', 'Préavis', 'Préférence', 'Présence', 'Présentation',
            'Prestation', 'Prévention', 'Prévision', 'Prime', 'Priorité', 'Procédure', 'Procès', 'Process',
            'Production', 'Profession', 'Programme', 'Projet', 'Promotion', 'Proposition', 'Protection', 'Protocole',
            'Province', 'Provision', 'Publication', 'Qualification', 'Qualité', 'Quantité', 'Question', 'Questionnaire',
            'Quittance', 'Quota', 'Quotient', 'Radiation', 'Rapport', 'Réalisation', 'Réception', 'Récépissé',
            'Recherche', 'Réclamation', 'Recommandation', 'Reconnaissance', 'Recours', 'Recouvrement', 'Recrutement',
            'Récupération', 'Rédaction', 'Réduction', 'Référence', 'Réforme', 'Refus', 'Régime', 'Région', 'Registre',
            'Règle', 'Règlement', 'Régularisation', 'Rejet', 'Relation', 'Relevé', 'Remboursement', 'Remise',
            'Rémunération', 'Renouvellement', 'Renseignement', 'Répartition', 'Réponse', 'Report', 'Représentation',
            'Reprise', 'Requête', 'Réservation', 'Résidence', 'Résiliation', 'Résolution', 'Respect', 'Responsable',
            'Ressource', 'Restriction', 'Résultat', 'Retenue', 'Retour', 'Retraite', 'Réunion', 'Revalorisation',
            'Révision', 'Risque', 'Rubrique', 'Saisie', 'Salaire', 'Sanction', 'Santé', 'Satisfaction', 'Science',
            'Séance', 'Section', 'Sécurité', 'Séjour', 'Sélection', 'Séminaire', 'Senior', 'Sens', 'Sentence',
            'Séparation', 'Séquence', 'Série', 'Service', 'Session', 'Signature', 'Signification', 'Situation',
            'Social', 'Société', 'Solution', 'Sommaire', 'Source', 'Spécialité', 'Stage', 'Standard', 'Statistique',
            'Statut', 'Stock', 'Stratégie', 'Structure', 'Subvention', 'Succession', 'Suivi', 'Support',
            'Suppression', 'Surveillance', 'Suspension', 'Synthèse', 'Système', 'Tableau', 'Tarif', 'Taux',
            'Technique', 'Télé', 'Témoignage', 'Temps', 'Terminal', 'Territoire', 'Test', 'Texte', 'Thème',
            'Théorie', 'Timbre', 'Tirage', 'Titre', 'Total', 'Traduction', 'Traitement', 'Transaction', 'Transfert',
            'Transit', 'Transmission', 'Transport', 'Travail', 'Trésorerie', 'Tribunal', 'Type', 'Unité',
            'Urbanisme', 'Urgence', 'Usage', 'Usager', 'Utilisateur', 'Utilisation', 'Vacance', 'Validation',
            'Valeur', 'Variable', 'Variation', 'Véhicule', 'Vente', 'Vérification', 'Version', 'Visite', 'Volume',
            'Vote', 'Voyage', 'Zone'
        ];

        foreach ($typologies as $typology) {
            DB::table('typologies')->insert(['name' => $typology]);
        }
    }
}
