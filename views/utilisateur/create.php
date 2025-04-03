{% include 'layouts/header.php' %}

<main class="main-container">
  <h1>{% if utilisateur.id is defined %}Modifier{% else %}Ajouter{% endif %} un utilisateur</h1>
  <form method="post" action="{{ base }}/utilisateur/create" class="form-utilisateur">

    {% if utilisateur.id is defined %}
      <input type="hidden" name="id" value="{{ utilisateur.id }}">
    {% endif %}

    <label for="nom">Nom complet</label>
    <input type="text" name="nom" id="nom" value="{{ utilisateur.nom|default('') }}" required>
    {% if errors.nom %}<p class="error">{{ errors.nom }}</p>{% endif %}

    <label for="email">Adresse e-mail</label>
    <input type="email" name="email" id="email" value="{{ utilisateur.email|default('') }}" required>
    {% if errors.email %}<p class="error">{{ errors.email }}</p>{% endif %}

    <label for="mot_de_passe">{% if utilisateur.id is defined %}Nouveau mot de passe (laisser vide si inchangé){% else %}Mot de passe{% endif %}</label>
    <input type="password" name="mot_de_passe" id="mot_de_passe" {% if utilisateur.id is not defined %}required{% endif %}>
    {% if errors.mot_de_passe %}<p class="error">{{ errors.mot_de_passe }}</p>{% endif %}

    <label for="nom_utilisateur">Nom d'utilisateur</label>
    <input type="text" name="nom_utilisateur" id="nom_utilisateur" value="{{ utilisateur.nom_utilisateur|default('') }}" {% if utilisateur.id is defined %}disabled{% endif %} required>
    {% if errors.nom_utilisateur %}<p class="error">{{ errors.nom_utilisateur }}</p>{% endif %}

    <label for="adresse">Adresse postale</label>
    <input type="text" name="adresse" id="adresse" value="{{ utilisateur.adresse|default('') }}" required>
    {% if errors.adresse %}<p class="error">{{ errors.adresse }}</p>{% endif %}

    <label for="privilege_id">Privilège</label>
    <select name="privilege_id" id="privilege_id">
      {% for p in privileges %}
        <option value="{{ p.id }}" {% if utilisateur.privilege_id is defined and utilisateur.privilege_id == p.id %}selected{% endif %}>{{ p.privilege }}</option>
      {% endfor %}
    </select>
    {% if errors.privilege_id %}<p class="error">{{ errors.privilege_id }}</p>{% endif %}

    <button type="submit" class="btn">
      {% if utilisateur.id is defined %}Mettre à jour{% else %}Créer{% endif %}
    </button>
  </form>
</main>

{% include 'layouts/footer.php' %}
