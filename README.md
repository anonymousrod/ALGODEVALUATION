# ALGODEVALUATION

ALGODEVALUATION est une plateforme web Laravel conçue pour collecter et gérer les données des agences immobilières. Elle permet aux contributeurs de soumettre des informations sur les agences immobilières, qui sont ensuite validées par les administrateurs pour enrichir une base de données fiable.

## Fonctionnalités

### Pour les Contributeurs
- **Soumission d'Agences** : Formulaire intuitif pour soumettre plusieurs agences immobilières
- **Anonymat Optionnel** : Possibilité de contribuer de manière anonyme ou avec un pseudo
- **Validation des Données** : Chaque soumission est examinée par les administrateurs
- **Récompenses** : Système de récompenses pour les contributions validées

### Pour les Administrateurs
- **Tableau de Bord** : Vue d'ensemble des statistiques (soumissions, agences, contributeurs)
- **Gestion des Soumissions** : Validation ou rejet des soumissions avec historique
- **Gestion des Agences** : Liste des agences validées avec informations complètes
- **Gestion des Contributeurs** : Suivi des contributions et statistiques par contributeur
- **Exports** : Export des données en CSV et PDF pour agences, contributeurs et soumissions
- **Authentification Sécurisée** : Système d'authentification dédié aux administrateurs

## Technologies Utilisées

- **Backend** : Laravel 12.0 (PHP 8.2+)
- **Frontend** : HTML5, CSS3, JavaScript (avec Vite pour le build)
- **Base de Données** : MySQL/SQLite (configurable)
- **Authentification** : Laravel Sanctum
- **Exports PDF** : DomPDF
- **UI/UX** : Design responsive avec animations CSS

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- Node.js et npm
- MySQL ou SQLite

## Installation

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

   Configurer la base de données dans `.env` :
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=algodevaluation
   DB_USERNAME=votre_username
   DB_PASSWORD=votre_password
   ```

5. **Migration et seeding de la base de données**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Lier le stockage**
   ```bash
   php artisan storage:link
   ```

7. **Build des assets**
   ```bash
   npm run build
   ```

8. **Démarrer le serveur**
   ```bash
   php artisan serve
   ```

   Pour le développement avec hot reload :
   ```bash
   composer run dev
   ```

## Utilisation

### Accès Public
- **Page d'accueil** : `/` - Présentation du projet et lien vers le formulaire de soumission
- **Formulaire de soumission** : `/submit` - Soumission d'agences immobilières

### Accès Administrateur
- **Connexion** : `/login` - Authentification administrateur
- **Tableau de bord** : `/admin` - Vue d'ensemble et statistiques
- **Soumissions** : `/admin/submissions` - Gestion des soumissions
- **Agences** : `/admin/agencies` - Liste des agences validées
- **Contributeurs** : `/admin/contributors` - Gestion des contributeurs
- **Exports** : Fonctionnalités d'export disponibles sur chaque section

## Structure du Projet

```
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminController.php      # Gestion admin
│   │   ├── ApiController.php        # API pour soumissions
│   │   └── AuthController.php       # Authentification
│   └── Models/
│       ├── Agency.php               # Modèle Agence
│       ├── Contributor.php          # Modèle Contributeur
│       ├── Submission.php           # Modèle Soumission
│       └── User.php                 # Modèle Utilisateur
├── database/migrations/             # Migrations base de données
├── public/                          # Assets publics
├── resources/
│   ├── css/                         # Styles CSS
│   ├── js/                          # JavaScript
│   └── views/                       # Templates Blade
│       ├── admin/                   # Vues admin
│       ├── auth/                    # Vues authentification
│       ├── submit.blade.php         # Formulaire soumission
│       └── welcome.blade.php        # Page d'accueil
├── routes/
│   ├── api.php                      # Routes API
│   └── web.php                      # Routes web
└── tests/                           # Tests unitaires et fonctionnels
```

## API

### Endpoint de Soumission
- **URL** : `/api/submit`
- **Méthode** : POST
- **Body** :
  ```json
  {
    "anonymous": false,
    "pseudo": "contributeur123",
    "phone": "+33123456789",
    "agencies": [
      {
        "name": "Agence Immobilière Example",
        "email": "contact@example.com",
        "phone": "+33123456789",
        "siege": "123 Rue de la République, 75001 Paris"
      }
    ]
  }
  ```

## Développement

### Scripts Disponibles
```bash
# Développement avec rechargement automatique
composer run dev

# Tests
php artisan test

# Analyse du code
./vendor/bin/pint

# Génération de documentation (si applicable)
php artisan ide-helper:generate
```

### Variables d'Environnement
Principales variables à configurer dans `.env` :
- `APP_NAME` : Nom de l'application
- `APP_URL` : URL de base
- `DB_*` : Configuration base de données
- `MAIL_*` : Configuration email (optionnel)

## Déploiement

### Préparation pour la Production
1. Optimiser l'autoloader :
   ```bash
   composer install --optimize-autoloader --no-dev
   ```

2. Générer les assets optimisés :
   ```bash
   npm run build
   ```

3. Configurer les permissions :
   ```bash
   chown -R www-data:www-data storage bootstrap/cache
   chmod -R 775 storage bootstrap/cache
   ```

4. Configurer le cache :
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

### Serveur Web
Le projet est compatible avec Apache/Nginx. Assurez-vous que le `DocumentRoot` pointe vers le dossier `public/`.

## Contribution

1. Fork le projet
2. Créer une branche feature (`git checkout -b feature/nouvelle-fonctionnalite`)
3. Commit les changements (`git commit -am 'Ajout nouvelle fonctionnalité'`)
4. Push vers la branche (`git push origin feature/nouvelle-fonctionnalite`)
5. Créer une Pull Request

## Tests

```bash
# Exécuter tous les tests
php artisan test

# Tests avec couverture
php artisan test --coverage
```

## Sécurité

- Authentification sécurisée pour l'accès admin
- Validation des données côté serveur
- Protection CSRF sur tous les formulaires
- Sanitisation des entrées utilisateur

## Licence

Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.

## Support

Pour toute question ou problème :
- Créer une issue sur GitHub
- Contacter l'équipe de développement

---

**ALGODEVALUATION** - Enrichissons ensemble la base de données immobilière !
