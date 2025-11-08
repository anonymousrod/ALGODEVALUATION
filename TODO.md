# Restructuration du projet - Sécurisation admin

## Étape 1: Supprimer les liens directs vers admin
- [x] Retirer la section "Accès Admin (MVP - accès direct)" de submit.blade.php
- [x] Garder seulement le lien "Connexion Admin" dans welcome.blade.php

## Étape 2: Mettre en place l'authentification admin
- [x] Créer app/Http/Controllers/AuthController.php
- [x] Ajouter les routes pour login (GET/POST) et logout dans routes/web.php
- [x] Créer resources/views/auth/login.blade.php
- [x] Modifier database/seeders/DatabaseSeeder.php pour créer un admin user
- [x] Supprimer la route setup-database de routes/web.php

## Étape 3: Nettoyer et réorganiser
- [x] Supprimer les fichiers inutiles (query_submissions.php, test_db.php, test_submit.php)
- [x] Réorganiser les routes pour suivre les conventions Laravel

## Étape 4: Améliorer la logique globale
- [x] Ajouter une route dashboard admin pour rediriger après login
- [x] Améliorer les vues admin avec navigation cohérente
- [ ] Ajouter des vérifications d'autorisation si nécessaire

## Étape 5: Nouvelles fonctionnalités demandées
- [x] Ne pas masquer les numéros de téléphone des contributeurs dans les vues admin
- [x] Ajouter fonctionnalité de validation des soumissions (approuver/rejeter)
- [x] Après validation, ajouter l'agence à la liste des agences
- [x] Ajouter export PDF pour les agences
- [x] Mettre à jour les modèles et migrations si nécessaire
- [x] Afficher le nombre de contributions validées pour chaque contributeur
