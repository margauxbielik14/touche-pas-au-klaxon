# 🚗 Touche pas au klaxon

Application web de covoiturage inter-sites développée dans le cadre de ma formation en développement web.

L'application permet aux employés d'une entreprise de consulter et de proposer des trajets entre différentes agences. Elle dispose également d'un espace d'administration permettant de gérer les agences, les utilisateurs et les trajets.

## Fonctionnalités

### Visiteur

- Consulter les trajets à venir disposant encore de places.
- Visualiser l'agence de départ et l'agence d'arrivée.
- Consulter les dates et horaires des trajets.
- Voir le nombre de places disponibles.
- Se connecter à l'application.

### Utilisateur connecté

En plus des fonctionnalités accessibles aux visiteurs, un utilisateur connecté peut :

- consulter les informations détaillées d'un trajet ;
- consulter les coordonnées de la personne proposant le trajet ;
- proposer un nouveau trajet ;
- modifier ses propres trajets ;
- supprimer ses propres trajets.

### Administrateur

L'administrateur dispose d'un tableau de bord lui permettant de :

- consulter la liste des utilisateurs ;
- consulter les agences ;
- créer, modifier et supprimer une agence ;
- consulter l'ensemble des trajets ;
- modifier ou supprimer un trajet.

Les employés sont issus des données de l'entreprise et ne peuvent pas être créés, modifiés ou supprimés depuis l'application.

## Technologies utilisées

### Back-end

- PHP 8
- MySQL
- PDO
- Architecture MVC
- Composer
- Dotenv

### Front-end

- HTML5
- Bootstrap
- Sass
- JavaScript

### Qualité et tests

- PHPUnit
- PHPStan
- Git
- GitHub

## Prérequis

Pour installer le projet, il est nécessaire de disposer de :

- PHP 8 ou supérieur ;
- MySQL ;
- Composer ;
- Node.js et npm.

## Installation

Cloner le dépôt :

```bash
git clone https://github.com/margauxbielik14/touche-pas-au-klaxon.git
```

Se placer dans le dossier du projet :

```bash
cd touche-pas-au-klaxon
```

Installer les dépendances PHP :

```bash
composer install
```

Installer les dépendances front-end :

```bash
npm install
```

Compiler les fichiers Sass :

```bash
npm run sass
```

## Configuration

Créer un fichier `.env` à la racine du projet à partir du fichier `.env.example`.

Exemple :

```env
DB_HOST=localhost
DB_PORT=3306
DB_NAME=covoiturage_entreprise
DB_USER=root
DB_PASSWORD=votre_mot_de_passe
```

Adapter les informations de connexion à votre environnement MySQL.

Le fichier `.env` contient des informations sensibles et n'est pas versionné sur GitHub.

## Base de données

La base de données principale utilisée par l'application est :

```text
covoiturage_entreprise
```

Les fichiers SQL nécessaires sont disponibles dans le dossier `database/` :

- `schema.sql` : création de la base de données et de sa structure ;
- `fixtures.sql` : insertion des données de démonstration (employés, agences et trajets) ;
- `test_schema.sql` : structure de la base de données utilisée par PHPUnit.

Pour initialiser l'application, importer d'abord :

```text
database/schema.sql
```

puis :

```text
database/fixtures.sql
```

## Lancement de l'application

Depuis la racine du projet, lancer le serveur PHP :

```bash
php -S localhost:8000 -t public
```

L'application est ensuite accessible dans le navigateur à l'adresse :

```text
http://localhost:8000
```

## Comptes de démonstration

### Administrateur

```text
Email : alexandre.martin@email.fr
Mot de passe : Admin123!
```

### Utilisateur

```text
Email : sophie.dubois@email.fr
Mot de passe : User123!
```

## Tests

Une base de données de test séparée est utilisée afin de ne pas modifier les données de l'application principale.

Créer un fichier `.env.test` et configurer notamment :

```env
DB_NAME=covoiturage_entreprise_test
```

Puis créer la base de test à partir de :

```text
database/test_schema.sql
```

Lancer les tests PHPUnit :

```bash
vendor/bin/phpunit
```

État actuel des tests :

```text
6 tests, 24 assertions
```

## Analyse statique

L'analyse statique du projet peut être lancée avec :

```bash
vendor/bin/phpstan analyse
```

Le projet est configuré avec PHPStan niveau 6.

## Sécurité

Plusieurs mesures de sécurité ont été mises en place :

- mots de passe stockés sous forme de hash ;
- requêtes SQL préparées avec PDO ;
- protection CSRF des actions sensibles ;
- contrôle des autorisations USER / ADMIN ;
- contrôle de propriété des trajets ;
- validation des données reçues ;
- échappement des données affichées afin de limiter les risques XSS ;
- variables sensibles stockées dans des fichiers `.env` non versionnés.

## Structure du projet

```text
TOUCHE PAS AU KLAXON/
├── app/
│   ├── Controllers/
│   ├── Core/
│   └── Repositories/
├── database/
├── public/
│   └── assets/
├── src/
│   └── scss/
├── templates/
│   ├── admin/
│   ├── auth/
│   ├── layouts/
│   └── trips/
├── tests/
├── .env.example
├── composer.json
├── package.json
├── phpstan.neon
├── phpunit.xml
└── README.md
```

## Auteur

**Margaux Bielik**

Projet réalisé dans le cadre de ma formation en développement web.