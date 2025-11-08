# ALGODEVALUATION - Collecte de Données d'Agences Immobilières

## Description

ALGODEVALUATION est une plateforme web développée avec Laravel permettant la collecte collaborative de données d'agences immobilières. Les utilisateurs peuvent soumettre des informations sur les agences immobilières, qui sont ensuite validées par des administrateurs. Le système inclut un algorithme de matching pour détecter les doublons et une interface d'administration complète.

### Pour les Contributeurs
- Soumission d'informations d'agences immobilières (nom, email, téléphone, siège)
- Possibilité de contribuer de manière anonyme ou avec coordonnées
- Soumission multiple d'agences en une seule fois
- Algorithme de matching automatique pour éviter les doublons

### Pour les Administrateurs
- Tableau de bord avec statistiques générales
- Gestion des soumissions (approbation/rejet)
- Validation automatique des agences approuvées
- Gestion des agences et contributeurs
- Exports CSV et PDF
- Authentification sécurisée

## Technologies Utilisées

- **Backend**: Laravel 12
- **Base de données**: MySQL/SQLite
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla)
- **PDF Generation**: DomPDF
- **Authentification**: Laravel Sanctum (pour admin)

## Installation

### Prérequis
- PHP 8.2 ou supérieur
- Composer
- Node.js et npm
- MySQL ou SQLite

### Étapes d'installation

1. **Cloner le repository**
   ```bash
   git clone <repository-url>
   cd algodevaluation
   ```

2. **Installer les dépendances PHP**
   ```bash
   composer install
   ```

3. **Installer les dépendances JavaScript**
   ```bash
   npm install
   ```

4. **Configuration de l'environnement**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configuration de la base de données**
   - Modifier le fichier `.env` avec vos paramètres de base de données
   - Exécuter les migrations :
   ```bash
   php artisan migrate
   ```

6. **Seeder la base de données (optionnel)**
   ```bash
   php artisan db:seed
   ```

7. **Compiler les assets**
   ```bash
   npm run build
   ```

8. **Démarrer le serveur**
   ```bash
   php artisan serve
   ```

   Ou utiliser le script de développement fourni :
   ```bash
   composer run dev
   ```

## Utilisation

### Accès Public
- **Page d'accueil**: `/`
- **Soumission d'agences**: `/submit`
- **Connexion admin**: `/login`

### Accès Administrateur
- **Tableau de bord**: `/admin`
- **Soumissions**: `/admin/submissions`
- **Agences**: `/admin/agencies`
- **Contributeurs**: `/admin/contributors`

### API
- **Soumission d'agences**: `POST /api/submit`

## Structure de la Base de Données

### Tables Principales

#### `contributors`
- `id`: Identifiant unique
- `pseudo`: Pseudo du contributeur (nullable)
- `phone`: Numéro de téléphone (nullable)
- `is_anonymous`: Indicateur d'anonymat
- `contributions_count`: Nombre total de contributions

#### `agencies`
- `id`: Identifiant unique
- `name`: Nom de l'agence
- `email`: Email de l'agence (nullable)
- `phone`: Téléphone de l'agence (nullable)
- `siege`: Adresse du siège (nullable)
- `canonical`: Indicateur d'agence validée

#### `submissions`
- `id`: Identifiant unique
- `contributor_id`: Référence au contributeur
- `agency_name`: Nom soumis
- `agency_email`: Email soumis (nullable)
- `agency_phone`: Téléphone soumis (nullable)
- `agency_siege`: Siège soumis (nullable)
- `matched_agency_id`: Référence à l'agence correspondante (nullable)
- `match_score`: Score de correspondance (0-100)
- `internet_check`: Statut de vérification internet
- `is_flagged`: Indicateur de signalement
- `status`: Statut (pending/approved/rejected)
- `validated_at`: Date de validation (nullable)
- `validated_by`: Référence à l'administrateur validateur

## Algorithme de Matching

L'algorithme compare les nouvelles soumissions avec les agences existantes en utilisant :
- **Similarité de nom** (70% du score)
- **Correspondance téléphone** (20% du score)
- **Correspondance email** (10% du score)

Un score > 70 déclenche un signalement automatique pour vérification manuelle.

## Exports

### Formats supportés
- **CSV**: Export simple des données
- **PDF**: Rapport formaté avec DomPDF

### Endpoints d'export
- `/admin/export/agencies` (CSV)
- `/admin/export/agencies/pdf` (PDF)
- `/admin/export/contributors` (CSV)
- `/admin/export/contributors/pdf` (PDF)
- `/admin/export/submissions` (CSV)
- `/admin/export/submissions/pdf` (PDF)

## Sécurité

- Authentification Laravel pour l'accès admin
- Protection CSRF sur tous les formulaires
- Validation des données côté serveur
- Sanitisation des entrées utilisateur

## Développement

### Scripts disponibles
```bash
# Développement avec rechargement automatique
composer run dev

# Tests
composer run test

# Analyse du code
./vendor/bin/pint
```

### Structure du projet
```
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php
│   │   ├── Api/
│   │   │   └── SubmissionController.php
│   │   └── AuthController.php
│   └── Models/
│       ├── Agency.php
│       ├── Contributor.php
│       ├── Submission.php
│       └── User.php
├── database/migrations/
├── resources/views/
│   ├── admin/
│   ├── auth/
│   ├── submit.blade.php
│   └── welcome.blade.php
├── routes/
│   ├── api.php
│   └── web.php
└── public/assets/
```

## Contribution

1. Fork le projet
2. Créer une branche feature (`git checkout -b feature/nouvelle-fonctionnalite`)
3. Commit les changements (`git commit -am 'Ajout nouvelle fonctionnalité'`)
4. Push la branche (`git push origin feature/nouvelle-fonctionnalite`)
5. Créer une Pull Request

## Licence

Ce projet est sous licence MIT.

## Support

Pour toute question ou problème, veuillez créer une issue sur le repository GitHub.
