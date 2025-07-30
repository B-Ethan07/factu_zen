# Gestion des Clients - Application Symfony

Cette application Symfony 7.3 permet de gérer une liste de clients avec des fonctionnalités de recherche.

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- MySQL

## Installation

### 1. Cloner le dépôt

```bash
git clone <https://github.com/B-Ethan07/factu_zen.git>
cd <factu_zen>
```

### 2. Installer les dépendances

```bash
composer install
```

Cette commande installera toutes les dépendances nécessaires, notamment :
- Symfony 7.3
- Doctrine ORM
- Twig
- FakerPHP/Faker (pour les fixtures)

### 3. Configurer la base de données

L'application utilise MySQL par défaut. Créez un fichier `.env.local` à la racine du projet pour configurer la connexion à votre base de données :

```
DATABASE_URL="mysql://utilisateur:mot_de_passe@127.0.0.1:3306/nom_base_de_donnees?serverVersion=8.0.32&charset=utf8mb4"
```

Remplacez `utilisateur`, `mot_de_passe` et `nom_base_de_donnees` par vos informations de connexion MySQL. Ajustez `serverVersion` selon votre version de MySQL.

Un fichier `.env.local.example` est fourni comme modèle. Vous pouvez le copier :

```bash
cp .env.local.example .env.local
```

Puis modifiez-le avec vos informations de connexion.

### 4. Créer la base de données

```bash
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
```

### 5. Charger les fixtures (données de test)

```bash
php bin/console doctrine:fixtures:load
```

Cette commande génère des clients de test en utilisant Faker.

### 6. Démarrer le serveur de développement

```bash
php bin/console server:start
# ou avec Symfony CLI
symfony server:start
```

## Fonctionnalités

- Affichage de la liste des clients (`/clients`)
- Affichage des détails d'un client (`/clients/{id}`)
- Recherche de clients par nom (`/clients/search?name=...`)

## Structure du projet

- `src/Controller/ClientController.php` : Contrôleur gérant les routes liées aux clients
- `src/Entity/Client.php` : Entité représentant un client
- `src/Repository/ClientRepository.php` : Repository avec méthodes personnalisées
- `templates/clients/` : Templates Twig pour l'affichage

## Protection de la branche principale

La branche `main` est protégée contre les push directs. Pour contribuer :

1. Créez une branche de fonctionnalité : `git checkout -b feature/ma-fonctionnalite`
2. Effectuez vos modifications et committez
3. Poussez votre branche : `git push origin feature/ma-fonctionnalite`
4. Créez une pull request via l'interface web

## Tests

Pour exécuter les tests :

```bash
php bin/phpunit
```
