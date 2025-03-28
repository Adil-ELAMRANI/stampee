{% include 'layouts/header.php' %}

<main class="main-container">
  <h1>Modifier l'utilisateur</h1>

  <form method="post" action="{{ base }}/utilisateur/update" class="form-utilisateur">
  
    <!-- Champ caché pour l'ID -->
    <input type="hidden" name="id" value="{{ utilisateur.id }}">

    <!-- Nom -->
    <label for="nom">Nom complet</label>
    <input type="text" name="nom" id="nom" value="{{ utilisateur.nom | e }}" required>
    {% if errors.nom %}
      <p class="error">{{ errors.nom }}</p>
    {% endif %}

    <!-- Email -->
    <label for="email">Adresse e-mail</label>
    <input type="email" name="email" id="email" value="{{ utilisateur.email | e }}" required>
    {% if errors.email %}
      <p class="error">{{ errors.email }}</p>
    {% endif %}

    <!-- Mot de passe -->
    <label for="mot_de_passe">Nouveau mot de passe <span style="font-size: 0.9rem;">(laisser vide pour ne pas changer)</span></label>
    <input type="password" name="mot_de_passe" id="mot_de_passe">

    <!-- Nom utilisateur (non modifiable) -->
    <label for="nom_utilisateur">Nom d'utilisateur</label>
    <input type="text" id="nom_utilisateur" value="{{ utilisateur.nom_utilisateur | e }}" disabled>

    <!-- Adresse -->
    <label for="adresse">Adresse postale</label>
    <input type="text" name="adresse" id="adresse" value="{{ utilisateur.adresse | e }}" required>
    {% if errors.adresse %}
      <p class="error">{{ errors.adresse }}</p>
    {% endif %}

    <!-- Privilège -->
    <label for="privilege_id">Privilège</label>
    <select name="privilege_id" id="privilege_id" required>
      {% for p in privileges %}
        <option value="{{ p.id }}"
          {% if utilisateur.privilege_id == p.id %}
            selected
          {% endif %}
        >
          {{ p.privilege }}
        </option>
      {% endfor %}
    </select>
    {% if errors.privilege_id %}
      <p class="error">{{ errors.privilege_id }}</p>
    {% endif %}

    <!-- Bouton de soumission -->
    <button type="submit" class="btn">Mettre à jour</button>
  </form>
</main>

{% include 'layouts/footer.php' %}
