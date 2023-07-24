# TestKissthebride
# 🐳 Docker + PHP 8.2 + MySQL + Nginx + Symfony 6.2 + Api platform + JWT

## Description

Il s'agit d'une application de gestion commerciales et frais.

Il est composé de 3 conteneurs :

- `nginx`, agissant en tant que serveur Web.
- `php`, le conteneur PHP-FPM avec la version 8.2 de PHP.
- `db` qui est le conteneur de la base de données MySQL avec une image **MySQL**.

## Prérequis

1. Installez DOCKER.

## Installation

1. 😀 Clonez ce dépôt.

2. Allez dans le dossier `./docker` et exécutez `docker compose up -d` pour démarrer les conteneurs.

3. Dans le conteneur `php`, exécutez `composer install` pour installer les dépendances à partir du dossier `/var/www/symfony`.

4. Création database `symfony console doctrine:migrations:migrate` et execution les migarations symfony `symfony console doctrine:migrations:migrate.

5. Allez sur `http://127.0.0.1/api` ou `http://testkissthebride.local/api/` pour voir la documentation Api.

6. Ajouter des Users à travers ce route `http://testkissthebride.local/api/register` en utlisant :
`{
   "email": "test@mail.com",
   "password": "test",
   "nom": "Joe",
   "prenom": "Doe",
   "date_naissance": "24-06-1987"
   }`par example.

7. Récupérer le Token JWT à partir ce route `http://testkissthebride.local/api/login_check` en utlisant :
   `{
   "email": "test@mail.com",
   "password": "test"
   }`par example.

8. Utiliser le token généré pour executer les api `NoteFrais`.