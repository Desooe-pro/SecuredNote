<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->integer("userId");
            $table->string("title", 100);
            $table->text("content");
            $table->timestamps();
        });

        $notes = [
            [
                'userId' => 1,
                'title' => 'Réunion équipe marketing',
                'content' => 'Points à aborder lors de la prochaine réunion :
                                - Campagne publicitaire Q2
                                - Budget marketing pour 2025
                                - Nouvelles stratégies réseaux sociaux
                                - Analyse des performances actuelles
                                - Planning des événements'
            ],
            [
                'userId' => 1,
                'title' => 'Liste courses hebdomadaires',
                'content' => 'Ne pas oublier d\'acheter :
                                - Lait et yaourts
                                - Pain complet
                                - Légumes frais (carottes, brocolis)
                                - Fruits de saison
                                - Produits d\'entretien
                                - Café en grains'
            ],
            [
                'userId' => 1,
                'title' => 'Idées projet web',
                'content' => 'Fonctionnalités à développer :
                                1. Système d\'authentification sécurisé
                                2. Dashboard utilisateur personnalisé
                                3. API REST pour mobile
                                4. Module de notifications push
                                5. Interface d\'administration
                                6. Système de cache Redis'
            ],
            [
                'userId' => 1,
                'title' => 'Objectifs fitness 2025',
                'content' => 'Programme d\'entraînement :
                                - Courir 3 fois par semaine (30 min minimum)
                                - Musculation 2 fois par semaine
                                - Yoga le dimanche matin
                                - Suivre alimentation équilibrée
                                - Boire 2L d\'eau par jour
                                - Dormir 8h minimum'
            ],
            [
                'userId' => 1,
                'title' => 'Recette tarte aux pommes',
                'content' => 'Ingrédients :
                                - 4 pommes Golden
                                - 1 pâte brisée
                                - 3 œufs
                                - 200ml crème fraîche
                                - 80g sucre
                                - 1 c.à.s vanille

                                Cuisson : 180°C pendant 35 minutes
                                Servir tiède avec boule de glace vanille'
            ],
            [
                'userId' => 1,
                'title' => 'Livres à lire',
                'content' => 'Ma liste de lecture :
                                1. "Clean Code" - Robert Martin
                                2. "Design Patterns" - Gang of Four
                                3. "The Pragmatic Programmer" - Hunt & Thomas
                                4. "Refactoring" - Martin Fowler
                                5. "Domain-Driven Design" - Eric Evans'
            ],
            [
                'userId' => 1,
                'title' => 'Voyage été 2025',
                'content' => 'Destinations potentielles :
                                - Grèce (Santorin, Mykonos)
                                - Portugal (Porto, Lisbonne)
                                - Italie (Toscane, Rome)
                                - Espagne (Andalousie)

                                À prévoir :
                                - Réservation hôtel
                                - Billets d\'avion
                                - Assurance voyage
                                - Documentation/guides'
            ],
            [
                'userId' => 1,
                'title' => 'Maintenance voiture',
                'content' => 'Entretien à effectuer :
                                - Vidange tous les 15 000 km
                                - Vérification pneus et pression
                                - Contrôle technique avant septembre
                                - Changement filtres (air, habitacle)
                                - Vérification freins et amortisseurs
                                - Nettoyage complet intérieur/extérieur'
            ],
            [
                'userId' => 1,
                'title' => 'Configuration serveur',
                'content' => 'Setup environnement production :
                                - Ubuntu 22.04 LTS
                                - Nginx + PHP 8.2
                                - MySQL 8.0
                                - Redis pour cache
                                - SSL Let\'s Encrypt
                                - Monitoring avec Grafana
                                - Backups automatiques quotidiens'
            ],
            [
                'userId' => 1,
                'title' => 'Cadeau anniversaire Marie',
                'content' => 'Idées cadeaux pour Marie (30 ans) :
                                - Bijoux (collier or rose)
                                - Parfum (Chanel ou Dior)
                                - Weekend spa détente
                                - Cours de cuisine italienne
                                - Livre de photographie
                                - Plante d\'intérieur rare
                                Budget max : 150€'
            ],
            [
                'userId' => 1,
                'title' => 'Jardin printemps',
                'content' => 'Travaux jardinage mars-avril :
                                - Tailler rosiers et arbustes
                                - Semer radis, carottes, laitues
                                - Planter pommes de terre
                                - Préparer massifs fleurs
                                - Nettoyer bassin
                                - Réparer clôture côté nord
                                - Acheter terreau et engrais'
            ],
            [
                'userId' => 1,
                'title' => 'Mots de passe à changer',
                'content' => 'Comptes à sécuriser :
                                - Email principal (Gmail)
                                - Banque en ligne
                                - Réseaux sociaux (Facebook, Instagram)
                                - Comptes cloud (Dropbox, Google Drive)
                                - Plateformes travail (Slack, Trello)
                                - Boutiques en ligne (Amazon, etc.)
                                Utiliser gestionnaire mots de passe'
            ],
            [
                'userId' => 1,
                'title' => 'Film/séries à regarder',
                'content' => 'Watchlist entertainment :
                                Séries :
                                - The Crown (saison finale)
                                - Succession (rewatch)
                                - The Bear (nouvelles saisons)

                                Films :
                                - Dune 2
                                - Everything Everywhere All at Once
                                - Top Gun Maverick
                                - Avatar 2'
            ],
            [
                'userId' => 1,
                'title' => 'Budget mensuel avril',
                'content' => 'Répartition budget 2500€ :
                                - Loyer : 800€
                                - Courses : 300€
                                - Transport : 150€
                                - Assurances : 120€
                                - Téléphone/Internet : 60€
                                - Loisirs : 200€
                                - Épargne : 500€
                                - Divers : 370€

                                Objectif : économiser 20% revenus'
            ],
            [
                'userId' => 1,
                'title' => 'Checklist déménagement',
                'content' => 'Étapes déménagement juillet :
                                □ Chercher nouveau logement
                                □ Préavis 3 mois propriétaire
                                □ Résilier contrats (électricité, gaz, internet)
                                □ Changement adresse (banque, assurance, CAF)
                                □ Réserver camion déménagement
                                □ Emballer affaires par pièce
                                □ État des lieux sortant'
            ]
        ];

        foreach ($notes as $note){
            DB::table('notes')->insert([
                "userId" => $note["userId"],
                "title" => $note["title"],
                "content" => $note["content"]
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
