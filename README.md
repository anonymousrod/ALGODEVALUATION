# ALGODEVALUATION - Collecte de Données d'Agences Immobilières

## Description

ALGODEVALUATION est une plateforme web développée avec Laravel permettant la collecte collaborative de données d'agences immobilières. Les utilisateurs peuvent soumettre des informations sur les agences immobilières, qui sont ensuite validées par des administrateurs. Le système inclut un algorithme de matching pour détecter les doublons et une interface d'administration complète.

a
### Pour les Contributeurs
- Soumission d'informations d'agences immobilières (nom, email, téléphone, siège)
- Possibilité de contribuer de manière anonyme ou avec coordonnées
- Soumission multiple d'agences en une seule fois


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
