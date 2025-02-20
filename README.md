# symfony-tmdb

Une application Symfony 7 qui utilise l'API de [The Movie Database (TMDb)](https://www.themoviedb.org/) pour afficher les dernières sorties de films et séries, les prochaines sorties, et permettre la recherche de films et séries.

## Fonctionnalités

- **Sorties récentes** : Affiche les derniers films et séries publiés.
- **Prochaines sorties** : Affiche les films et séries à venir.
- **Recherche** : Permet à l'utilisateur de rechercher des films et des séries par titre.
- **Détails des films et séries** : Affiche des informations détaillées sur chaque film ou série, y compris la description, la note, les acteurs, etc.

## Prérequis

Avant de commencer, assurez-vous que vous avez installé les éléments suivants :

- [PHP](https://www.php.net/) (version 8.1 ou supérieure)
- [Composer](https://getcomposer.org/) pour gérer les dépendances de Symfony
- [Symfony CLI](https://symfony.com/download) pour faciliter le développement avec Symfony

## Installation

1. Clonez ce repository :

   ```bash
   git clone https://github.com/ludovicdevio/symfony-tmdb.git
   cd symfony-tmdb
Installez les dépendances via Composer :

    composer install
Créez un fichier .env à la racine du projet et ajoutez votre clé API TMDb.

Exemple de contenu du fichier .env :

    TMDB_API_TOKEN="VOTRE_CLE_API_TMDB"

Pour obtenir votre clé API TMDb, inscrivez-vous sur The Movie Database et allez dans votre section "API" pour générer une clé.

Démarrez le serveur de développement Symfony :

    symfony serve:start -d

Vous pourrez accéder à l'application dans votre navigateur à l'adresse suivante : http://localhost:8000.

Technologies utilisées
Symfony 7 pour le framework backend.
Bootstrap pour la gestion du front-end et la mise en page responsive.
TMDb API pour obtenir des informations sur les films et séries.
Twig pour la gestion des templates.
HTTP Client Symfony pour effectuer des requêtes HTTP à l'API de TMDb.
Exemple de recherche
Vous pouvez rechercher un film ou une série en utilisant le champ de recherche. L'application affichera les résultats correspondant à votre recherche, ainsi que des informations détaillées telles que la description, la date de sortie, la note, et bien plus.

Déploiement
L'application est déjà déployée et accessible en ligne sur: https://tmdb.ludovicdev.com/ . Vous pouvez l'utiliser directement sans avoir besoin de configurer quoi que ce soit localement.

Contribuer
Les contributions sont les bienvenues ! Si vous souhaitez contribuer, veuillez suivre ces étapes :

Fork ce repository.
Créez une branche pour votre fonctionnalité (git checkout -b feature-nouvelle-fonctionnalité).
Committez vos modifications (git commit -am 'Ajout d'une nouvelle fonctionnalité').
Poussez votre branche (git push origin feature-nouvelle-fonctionnalité).
Ouvrez une pull request.
Licence
Ce projet est sous licence MIT.

Remerciements
[The Movie Database (TMDb)](https://www.themoviedb.org/) pour l'API gratuite et puissante.

