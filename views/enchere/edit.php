{% include 'layouts/header.php' %}
<div class="main-container">
  <h1>Modifier l’enchère</h1>

  <form method="post" action="{{ base }}/enchere/update" class="form-utilisateur">

    <input type="hidden" name="id" value="{{ enchere.id }}">

    <label for="timbre_id">Timbre</label>
    <select name="timbre_id" id="timbre_id" required>
      {% for t in timbres %}
      <option value="{{ t.id }}" {% if enchere.timbre_id == t.id %}selected{% endif %}>{{ t.nom }}</option>
      {% endfor %}
    </select>
    {% if errors.timbre_id %}
    <span class="error">{{ errors.timbre_id ?? '' }}</span>
    {% endif %}

    <label for="prix_minimale">Prix minimal</label>
    <input type="number" name="prix_minimale" id="prix_minimale" step="0.01" value="{{ enchere.prix_minimale|default('') }}" required>
    {% if errors.prix_minimale %}
    <span class="error">{{ errors.prix_minimale ?? '' }}</span>
    {% endif %}

    <label for="date_debut">Date de début</label>
    <input type="datetime-local" name="date_debut" id="date_debut" value="{{ enchere.date_debut }}" required>
    {% if errors.date_debut %}
    <span class="error">{{ errors.date_debut ?? '' }}</span>
    {% endif %}

    <label for="date_fin">Date de fin</label>
    <input type="datetime-local" name="date_fin" id="date_fin" value="{{ enchere.date_fin }}" required>
    {% if errors.date_fin %}
    <span class="error">{{ errors.date_fin ?? '' }}</span>
    {% endif %}

    <label for="coup_de_coeur">Coup de cœur du Lord ?</label>
    <input type="hidden" name="coup_de_coeur" value="0">
    <input type="checkbox" name="coup_de_coeur" id="coup_de_coeur" value="1" {% if enchere.coup_de_coeur %}checked{% endif %}>

    <input type="hidden" name="statut_enchere" value="{{ enchere.statut_enchere|default(1) }}">

    <button type="submit" class="btn">Mettre à jour</button>
  </form>
</div>
{% include 'layouts/footer.php' %}