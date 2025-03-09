# SnowTricks OCR PHP - Projet

Développez de A à Z le site communautaire SnowTricks

## Table des matières

1. [Prérequis](#prérequis)
2. [Installation](#installation)
3. [Utilisation](#utilisation)
4. [Documentation](#documentation)

## Prérequis

-   PHP version 8.3.4 : Le projet est compatible avec PHP8.
-   composer version 2.7.2 : Assurez-vous que Composer est installé pour gérer les dépendances.
-   twig version 3.8.0
-   Symfony 7.2
-   Une BDD (par exemple DBeaver)
-   MySQL : Version recommandée : 8.0.19 ou plus récent.
-   Serveur local : Apache ou un serveur équivalent pour exécuter l’application en local.


## Installation

1. Cloner le dépôt : 
 - Clonez ce dépôt sur votre machine locale.

2. Accéder au dossier du projet :
    - cd projects/
    - git clone ...

3. Installer les dépendances avec Composer :
    - composer install

4. Installer symfony (voir composer.json)
    - cd my-project/
    - composer install

5. Installer Twig

6. Préparer la base de données test : 
    - Configuration de la base de données Avant tout, assurez-vous d'avoir configuré votre connexion dans le fichier .env :
        - DATABASE_URL="mysql://votre_utilisateur:votre_mot_de_passe@127.0.0.1:3306/nom_de_votre_base" (exemple)
    -  Création de la base de données
        - php bin/console doctrine:database:create
    -  Création des migrations
        - php bin/console make:migration
    - Exécution des migrations
        - php bin/console doctrine:migrations:migrate
    - Chargement des données en BDD - voir le dump dans le dossier livrables/SnowTricks.sql


## Utilisation

Pour exécuter le projet :
    - cd my-project/

Accédez à l’application dans votre navigateur via http://127.0.0.1:8000/ :

    - symfony server:start

Utilisateur :

-   Dev
    -   ID : lauryanndev@gmail.com
    -   Mtp : F)HeY8s69}9t;s
-   User
    -   ID : testeur2602@mail.com
    -   Mtp : QXhUb94;g]6+4m

