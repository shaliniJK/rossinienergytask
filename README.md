# Test Technique pour Rossini Energy

## Configuration de l'environnement de développement

Ce projet nécéssite PHP >=7.2.0 et utilise le framework Lumen. Lumen utilise Composer pour la gestion des dépendances. Les données sont stockées dans une base MySQL.

Avant de lancer ce projet, il faut avoir installé sur votre machine :

-   PHP 7.3,
-   Composer,
-   MySQL

Après avoir cloné ce projet, assurez-vous d'avoir la dernière version de Composer et téléchargez les dépendances PHP du projet en saississant les commandes suivantes dans une terminale de commande:

```
composer install
```

Créer une copie du fichier .env à la racine du projet :

```
cp .env.example .env
```

Créer une base de données vide pour l'application sur MySQl.

Dans le fichier .env, indiquez les options DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME et DB_PASSWORD pour correspondre aux informations d'identification de la base de données que vous venez de créer.

Une fois que les informations d'identification sont dans le fichier .env, vous pouvez maintenant migrer votre base de données.

```
php artisan key:generate
php artisan migrate
```

Vous pouvez maintenant lancer un serveur de développement sur l'adresse http://localhost:8000 avec la commande :

```
php artisan serve
```

Il faut s'assurer d'avoir importer la table des bornes avec les données qui sont dans le fichier `/database/sql/test_technique.sql` avant de lancer le serveur de développement.
