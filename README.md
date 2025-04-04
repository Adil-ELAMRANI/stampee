# 📮 Stampee – Plateforme d’enchères de timbres

> Projet Web 1 — Conception et programmation de sites Web 582-32W-MA  
> Réalisé selon la méthode agile (SCRUM)

---

## 📌 Contexte

**Stampee** est une plateforme d’enchères de timbres commandée par Lord Reginald Stampee, un illustre philatéliste britannique.  
Elle permet aux membres du monde entier de publier et participer à des enchères de timbres rares.

---

## 🎯 Objectifs

- Permettre aux membres de publier et consulter des enchères
- Placer des offres en ligne
- Voir les timbres de près (zoom)
- Naviguer simplement sur la plateforme
- Accéder à une interface responsive sur tout appareil

---

## 🛠️ Technologies utilisées

- **HTML / CSS / JavaScript**
- **PHP (Architecture MVC)**
- **Twig** (moteur de templates)
- **MySQL** (base de données relationnelle)
- **Git** + **GitHub** (gestion de version)
- **Méthode SCRUM** (sprints + backlog)

---

## 🎨 Charte graphique

| Élément       | Choix retenu                |
|--------------|-----------------------------|
| Palette      | Rouge et Bleu (style classique anglais) |
| Typographie  | Roboto classique pour titres, sans-serif pour le contenu |
| Iconographie | Icônes sobres et vectorielles |
| Style global | Épuré, classique, soigné, accessible |

---

## 🧱 Structure MVC

- `/App/Controllers/` — Contrôleurs (ex: `TimbreController.php`)
- `/App/Models/` — Modèles (ex: `Timbre.php`, `Utilisateur.php`)
- `/App/Views/` — Vues (Twig)
- `/public/` — Entrée publique (`index.php`, CSS/JS/images)
- `/routes/` — Routes de l'application

---

## 📚 Entités principales

### 🖼️ Timbre

- Nom
- Date de création
- Pays d’origine
- Images (principale et secondaires)
- Condition (parfaite → endommagé)
- Tirage
- Dimensions
- Certifié (oui/non)

### 🕰️ Enchère

- Date de début / fin
- Prix plancher
- Coups de cœur du Lord (booléen)

---

## 📄 Pages principales

- **Accueil** : Mission, enchères en cours, coups de cœur du Lord
- **Fiche d'enchère** : Détails timbre + enchère, zoom, offres
- **Portail des enchères** : Enchères actives + archivées avec filtres
- **Devenir membre / Se connecter**
- **Profil membre** : Historique, offres placées
- **À propos de Lord Stampee**
- **Actualités**
- **Contact / Aide / Conditions**

---

## 🧩 Fonctionnalités clés

- Authentification et gestion de compte
- Publication d’enchères
- Placement d’offres
- Système de favoris (enchères coups de cœur)
- Filtres de recherche avancée (pays, date, condition…)
- Zoom sur les timbres
- Interface responsive

---

## 🏗️ Méthodologie SCRUM

### 🟩 SPRINT 0 ✅ Terminé

- ✔️ Charte de projet
- ✔️ Charte graphique
- ✔️ Maquettes des pages publiques
- ✔️ Modèle physique de données (MPD)
- ✔️ Product Backlog complet
- ✔️ Sprint backlog initial

### 🟩 SPRINT 1 ✅ Terminé

- ✔️ Connexion / déconnexion (login/logout)
- ✔️ CRUD complet pour les utilisateurs
- ✔️ Suivi des tâches (heures réelles, tâches finalisées ou non)
- ✔️ Mise à jour du MPD
- ✔️ Tests unitaires de base sur formulaire utilisateur

### 🟩 SPRINT 2 — ✅ Terminé

- ✔️ CRUD complet pour les timbres
- ✔️ Liaisons dynamiques avec les tables pays, certification, état_timbre
- ✔️ Upload d’image de timbre + modèle Image
- ✔️ CRUD enchères avec champ coup de cœur & statut
- ✔️ Vue enchère (create, edit, index)

### 🟨 SPRINT 3 — 🟨 À venir

- 🕗 Création du modèle Mise pour gérer les offres des utilisateurs
- 🕗 Développement du MiseController pour assurer les opérations CRUD des mises
- 🕗 Ajout des routes associées dans web.php
- 🕗 Affichage et interaction avec les enchères
- 🕗 Création du formulaire de mise accessible depuis chaque fiche d’enchère
- 🕗 Gestion des Encheres avec requêtes SQL directes insérant les enchères et offres
- 🕗 Gestion des favoris et du profil utilisateur
- 🕗 Ajout des routes pour la gestion des mises et favoris
- 🕗 Création de enchere/show pour une fiche enchère complète affichant tous les détails
...

_(reprendre selon l’avancement réel de mon projet)_

---
## 🌍 Accès au projet  

🔗 **Dépôt GitHub** : [Adil-ELAMRANI/stampee](https://github.com/Adil-ELAMRANI/stampee)  

🚀 **Démo en ligne** : [Stampee](https://e2395866.webdev.cmaisonneuve.qc.ca/stampee/)  

---

🙋 Contact
Adil EL AMRANI
GitHub : @Adil-ELAMRANI
