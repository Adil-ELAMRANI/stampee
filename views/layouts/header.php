<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{ title|default('Stampee') }}</title>

  <!-- Icônes et styles globaux -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="{{ asset }}/assets/css/styles.css">
  <link rel="stylesheet" href="{{ asset }}/assets/css/formulaire.css">
  <link rel="stylesheet" href="{{ asset }}/assets/css/pages/utilisateur.css?v=2">

</head>

<body>

  <header>
    <nav class="navigation_header">
      <img class="logo" src="{{ asset }}/assets/logosStampee/logo-2.png" alt="Logo Stampee">

      <div class="lien_page">
        <a href="{{ base }}/"><i class="fas fa-home interactive"></i> Accueil</a>
        <a href="{{ base }}/catalogue.html"><i class="fas fa-book interactive"></i> Catalogue</a>
        <a href="{{ base }}/enchere.html"><i class="fas fa-gavel interactive"></i> Enchères</a>

        {% if session.privilege_id == 1 %}
        <a href="{{ base }}/utilisateur/create"><i class="fas fa-users-cog interactive"></i> Utilisateurs</a>
        {% endif %}
      </div>

      <div class="connexion-langue">
        {% if guest %}
        <a href="{{ base }}/login" title="Connexion">
          <i class="fas fa-user"></i>
        </a>
        {% else %}
        <a href="{{ base }}/logout" title="Déconnexion">
          <i class="fas fa-sign-out-alt"></i>
        </a>
        {% endif %}

        <a href="#" title="Langue: Français">FR</a>
        <span>|</span>
        <a href="#" title="Langue: Anglais">EN</a>
      </div>
    </nav>

    {% if not guest %}
    <div class="user-bonjour">
      👋 Bonjour {{ session.nom_utilisateur }} !
    </div>
    {% endif %}
  </header>

  