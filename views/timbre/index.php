{% include 'layouts/header.php' %}

<main class="main-container">
  <h1>Liste des timbres</h1>

  <div class="actions-top">
    <a href="{{ base }}/timbre/create">
      <button>Ajouter un timbre</button>
    </a>
  </div>

  {% if timbres is empty %}
  <p>Aucun timbre enregistré.</p>
  {% else %}
  <table class="table-crud">
    <thead>
      <tr>
        <th>Image</th>
        <th>Nom</th>
        <th>Description</th>
        <th>Année</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      {% for t in timbres %}
      <tr>
        <td data-label="Image">
          {% if t.image %}
          <img src="{{ base }}/assets/img/timbres/{{ t.image }}" alt="Image de {{ t.nom }}" class="timbre-thumbnail">
          {% else %}
          <span style="color: #aaa;">(aucune)</span>
          {% endif %}
        </td>
        <td data-label="Nom">{{ t.nom }}</td>
        <td data-label="Description">{{ t.description }}</td>
        <td data-label="Année">{{ t.annee }}</td>
        <td data-label="Actions">
          <div class="action-buttons">
            <a href="{{ base }}/timbre/edit?id={{ t.id }}"><button>Modifier</button></a>
            <a href="{{ base }}/timbre/delete?id={{ t.id }}" onclick="return confirm('Supprimer ce timbre ?')"><button>Supprimer</button></a>
          </div>
        </td>
      </tr>
      {% endfor %}
    </tbody>
  </table>
  {% endif %}
</main>

{% include 'layouts/footer.php' %}