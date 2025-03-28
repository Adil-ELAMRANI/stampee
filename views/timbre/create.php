{% include 'layouts/header.php' %}

<main class="main-container">
  <h1>Ajouter un timbre</h1>

  <form method="post" action="{{ base }}/timbre/store" enctype="multipart/form-data" class="form-utilisateur">
    
    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" value="{{ timbre.nom|default('') }}" required>
    {% if errors.nom %}<p class="error">{{ errors.nom }}</p>{% endif %}

    <label for="description">Description</label>
    <textarea id="description" name="description" required>{{ timbre.description|default('') }}</textarea>
    {% if errors.description %}<p class="error">{{ errors.description }}</p>{% endif %}

    <label for="annee">Année</label>
    <input type="text" id="annee" name="annee" value="{{ timbre.annee|default('') }}" required>
    {% if errors.annee %}<p class="error">{{ errors.annee }}</p>{% endif %}

    <label for="image">Image du timbre</label>
    <input type="file" name="image" id="image" accept="image/*">

    <label for="pays_id">Pays</label>
    <select name="pays_id" id="pays_id" required>
      <option value="">-- Sélectionner un pays --</option>
      {% for p in pays %}
        <option value="{{ p.id }}" {% if timbre.pays_id == p.id %}selected{% endif %}>{{ p.nom_pays }}</option>
      {% endfor %}
    </select>

    <label for="certification_id">Certification</label>
    <select name="certification_id" id="certification_id" required>
      <option value="">-- Sélectionner une certification --</option>
      {% for c in certifications %}
        <option value="{{ c.id }}" {% if timbre.certification_id == c.id %}selected{% endif %}>{{ c.statut_certification }}</option>
      {% endfor %}
    </select>

    <label for="etat_timbre_id">État</label>
    <select name="etat_timbre_id" id="etat_timbre_id" required>
      <option value="">-- Sélectionner un état --</option>
      {% for e in etats %}
        <option value="{{ e.id }}" {% if timbre.etat_timbre_id == e.id %}selected{% endif %}>{{ e.etat }}</option>
      {% endfor %}
    </select>

    <label for="utilisateur_id">Utilisateur</label>
    <select name="utilisateur_id" id="utilisateur_id" required>
      <option value="">-- Sélectionner un utilisateur --</option>
      {% for u in utilisateurs %}
        <option value="{{ u.id }}" {% if timbre.utilisateur_id == u.id %}selected{% endif %}>
          {{ u.nom }} - {{ u.nom_utilisateur }}
        </option>
      {% endfor %}
    </select>

    <button type="submit" class="btn">Créer</button>
  </form>
</main>

{% include 'layouts/footer.php' %}
