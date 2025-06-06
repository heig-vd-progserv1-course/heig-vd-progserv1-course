# Cours 08 - Récapitulatif de l'unité d'enseignement avec préparation à l'examen et finalisation de l'application - Examen blanc

## Ressources

- Récapitulatif de l'unité d'enseignement :
  [Support de cours](../01-recapitulatif-de-lunite-denseignement-avec-preparation-a-lexamen/README.md)
  ·
  [Présentation (web)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/08-recapitulatif-de-lunite-denseignement-avec-preparation-a-lexamen-et-finalisation-de-lapplication/01-recapitulatif-de-lunite-denseignement-avec-preparation-a-lexamen/index.html)
  ·
  [Présentation (PDF)](https://heig-vd-progserv1-course.github.io/heig-vd-progserv1-course/08-recapitulatif-de-lunite-denseignement-avec-preparation-a-lexamen-et-finalisation-de-lapplication/01-recapitulatif-de-lunite-denseignement-avec-preparation-a-lexamen/08-recapitulatif-de-lunite-denseignement-avec-preparation-a-lexamen-et-finalisation-de-lapplication-presentation.pdf)
  ·
  [Résultats des formulaires de feedback](../01-recapitulatif-de-lunite-denseignement-avec-preparation-a-lexamen/feedback)
- Mini-projet : [Consignes](../02-mini-project/README.md) ·
  [Solution](../02-mini-project/solution/)
- Examen blanc : [Énoncé](../03-examen-blanc/README.md)

## Examen blanc

L'examen est composé de deux parties :

1. Partie théorique (~45 minutes, 40% de la note).
2. Partie pratique (~2 heures 15 minutes, 60% de la note).

> [!CAUTION]
>
> Toute tentative de tricherie ou d'utilisation de ressources non autorisées
> entraînera la note de 1 pour l'ensemble de l'examen.

### Partie théorique

> [!CAUTION]
>
> Quitter la plateforme (changement de fenêtre, fermeture du navigateur, etc.)
> durant la partie théorique de l'examen entraînera la note de 1 pour l'ensemble
> de l'examen.

#### Ressources autorisées

- Aucune

#### Lien vers la plateforme d'évaluation

[Lien sur la plateforme d'évaluation en ligne de la HEIG-VD](https://eval.heig-vd.ch/TODO).

#### Rendu

Soumettre les réponses via la plateforme d'évaluation en ligne de la HEIG-VD et
faire valider le rendu par la personne qui surveille l'examen. Vous aurez
ensuite accès à la partie pratique de l'examen.

### Partie pratique

> [!CAUTION]
>
> Le rendu doit être effectué **avant** la fin de la partie pratique de
> l'examen. En cas de non-remise ou de retard, la note de 1 sera attribuée pour
> la partie pratique de l'examen.

#### Ressources autorisées

- Un environnement de développement local (par exemple, MAMP + Visual Studio
  Code).
- Un navigateur web.
- Le
  [dépôt Git de l'unité d'enseignement](https://github.com/heig-vd-progserv1-course/heig-vd-progserv1-course),
  comprenant :
  - La théorie.
  - Le mini-projet et sa solution.
  - Les exercices et leurs solutions.
- Notes personnelles.
- Code source personnel.
- Documentation officielle de PHP (<https://www.php.net/>).
- Ressources MDN (<https://developer.mozilla.org>).

#### Rendu

Le rendu de la partie pratique se fait via mail à l'adresse
[ludovic.delafontaine@heig-vd.ch](mailto:ludovic.delafontaine@heig-vd.ch) dans
une archive ZIP ayant pour format `prenom_nom.zip`.

Par exemple, pour une personne nommée _Ludovic Delafontaine_, le rendu de
l'archive sera `ludovic_delafontaine.zip`.

Vous êtes responsable de son contenu.

Le travail et la consigne doivent être rendus avant la fin de l'examen.

#### Consignes

Vous venez de rejoindre une nouvelle équipe de développement web. Votre
responsable vous a demandé de créer une application web de gestion de projets.
Vous devez implémenter les fonctionnalités suivantes :

- Afficher la liste des projets.
- Afficher les détails d'un projet.
- Ajouter un nouveau projet.
- Modifier un projet existant.
- Supprimer un projet.

Chaque projet a les attributs suivants :

- Nom du projet (texte, obligatoire, minimum 2 caractères, maximum 100
  caractères).
- Description du projet (texte long, optionnel, minimum 10 caractères, maximum
  500 caractères).
- Statut du projet (sélection, obligatoire, valeurs possibles : _"En cours"_,
  _"Terminé"_, _"Annulé"_).
- Priorité du projet (boutons radio, obligatoire, valeurs possibles : _"Basse"_,
  _"Moyenne"_, _"Haute"_).
- Catégories du projet (cases à cocher, optionnel, valeurs possibles :
  _"Développement"_, _"Finances"_, _"Administration"_ ou _"Marketing"_).

La requête pour créer la base de données vous a été fournie afin de vous
simplifier le travail :

```sql
CREATE TABLE IF NOT EXISTS projets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name TEXT NOT NULL,
    description TEXT,
    status TEXT NOT NULL,
    priority TEXT NOT NULL,
    categories TEXT,
);
```

Réalisez cette application avec PHP en utilisant toutes les bonnes pratiques de
développement web que vous avez acquises durant l'unité d'enseignement.

#### Grille d'évaluation

- 0 point - Le travail est insuffisant
- 1 point - Le travail est réalisé mais nécessite des améliorations (manque de
  fonctionnalités ou de précision)
- 2 points - Le travail est réalisé et répond complètement aux attentes

> [!NOTE]
>
> Il n'y a aucun critère sur l'aspect visuel de l'application. Vous pouvez
> utiliser du HTML et du CSS de base (CSS optionnel), mais l'accent doit être
> mis sur la fonctionnalité et la structure du code.

> [!WARNING]
>
> Le code ne doit pas contenir de code sortant du contexte de l'application (pas
> de code ou commentaires inutiles, pas de code lié à d'autres projets (animaux
> de compagnie, etc.), etc.). Des points peuvent être retirés si le code
> contient des éléments inutiles ou hors contexte.

**Page d'accueil**

|   # | Description                                                                                            | Points |
| --: | :----------------------------------------------------------------------------------------------------- | -----: |
|   1 | Une page d'accueil permet d'afficher la liste des projets                                              |      2 |
|   2 | La page d'accueil affiche les projets avec les attributs suivants : nom, description, statut, priorité |      2 |
|   3 | La page d'accueil est protégée contre les attaques XSS                                                 |      2 |
|   4 | La page d'accueil permet de naviguer vers la page de création d'un nouveau projet                      |      2 |
|   5 | La page d'accueil permet de naviguer vers la page de visualisation d'un projet                         |      2 |
|   6 | La page d'accueil permet de naviguer vers la page d'édition d'un projet                                |      2 |
|   7 | La page d'accueil permet de naviguer vers la page de suppression d'un projet                           |      2 |

**Page de création d'un projet**

|   # | Description                                                                                                                                            | Points |
| --: | :----------------------------------------------------------------------------------------------------------------------------------------------------- | -----: |
|   8 | Une page de création permet de créer un nouveau projet                                                                                                 |      2 |
|   9 | La page de création affiche un formulaire avec les champs suivants : nom, description, statut, priorité, catégories                                    |      2 |
|  10 | La page de création supporte la validation des champs du formulaire (obligatoire, longueur minimale et maximale), autant côté serveur que côté serveur |      2 |
|  11 | La page de création affiche les erreurs de validation de manière claire et précise                                                                     |      2 |
|  12 | La page de création sauvegarde les données du formulaire en cas d'erreur de validation (pré-remplissage)                                               |      2 |
|  13 | La page de création sauvegarde le nouveau projet dans la base de données et redirige la personne vers la page d'accueil après la création d'un projet  |      2 |
|  14 | La page de création est protégée contre les injections SQL et les attaques XSS                                                                         |      2 |

**Page de visualisation d'un projet**

|   # | Description                                                                                                                         | Points |
| --: | :---------------------------------------------------------------------------------------------------------------------------------- | -----: |
|  15 | Une page de visualisation permet de visualiser les détails d'un projet                                                              |      2 |
|  16 | La page de visualisation affiche les détails du projet avec les attributs suivants : nom, description, statut, priorité, catégories |      2 |
|  17 | La page de visualisation est protégée contre les injections SQL et les attaques XSS                                                 |      2 |
|  18 | La page de visualisation permet de naviguer vers la page d'édition d'un projet                                                      |      2 |
|  19 | La page de visualisation permet de supprimer un projet                                                                              |      2 |
|  20 | La page de visualisation redirige l'utilisateur vers la page d'accueil si le projet n'existe pas                                    |      2 |

**Page d'édition d'un projet**

|   # | Description                                                                                                                                          | Points |
| --: | :--------------------------------------------------------------------------------------------------------------------------------------------------- | -----: |
|  21 | Une page d'édition permet de modifier un projet                                                                                                      |      2 |
|  22 | La page d'édition affiche un formulaire pré-rempli avec les données du projet                                                                        |      2 |
|  23 | La page d'édition supporte la validation des champs du formulaire (obligatoire, longueur minimale et maximale), autant côté serveur que côté serveur |      2 |
|  24 | La page d'édition affiche les erreurs de validation de manière claire et précise                                                                     |      2 |
|  25 | La page d'édition sauvegarde les données du formulaire en cas d'erreur de validation (pré-remplissage)                                               |      2 |
|  26 | La page d'édition met à jour le projet dans la base de données et redirige la personne vers la page de visualisation du projet après la modification |      2 |
|  27 | La page d'édition est protégée contre les injections SQL et les attaques XSS                                                                         |      2 |
|  28 | La page d'édition redirige l'utilisateur vers la page d'accueil si le projet n'existe pas                                                            |      2 |

**Page de suppression d'un projet**

|   # | Description                                                                                                                           | Points |
| --: | :------------------------------------------------------------------------------------------------------------------------------------ | -----: |
|  29 | Une page de suppression permet de supprimer un projet                                                                                 |      2 |
|  30 | La page de suppression redirige l'utilisateur vers la page d'accueil si le projet n'existe pas                                        |      2 |
|  31 | La page de suppression supprime le projet de la base de données et redirige l'utilisateur vers la page d'accueil après la suppression |      2 |
|  32 | La page de suppression est protégée contre les injections SQL                                                                         |      2 |

**Global**

|   # | Description                                                                                                       | Points |
| --: | :---------------------------------------------------------------------------------------------------------------- | -----: |
|  33 | Le code est lisible, agréable à lire et utilise des noms de variables/fonctions/fichiers/dossiers/etc. explicites |      2 |
|  34 | Le code est structuré avec les principes de la programmation orientée objet (POO)                                 |      2 |
