{% include 'layouts/header.php' %}
<div class="main-container">
  <h1>Liste des enchères</h1>
  <div class="actions-top">
    <a href="{{ base }}/enchere/create"><button>Ajouter une enchère</button></a>
  </div>
  {% if encheres is not empty %}
  <table class="table-crud">
    <thead>
      <tr>
        <th>ID</th>
        <th>Timbre</th>
        <th>Prix minimale</th>
        <th>Date début</th>
        <th>Date fin</th>
        <th>Statut</th>
        <th>Coup de cœur</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      {% for e in encheres %}
      <tr>
        <td>{{ e.id }}</td>
        <td>{{ e.timbre_nom ?? 'Non défini' }}</td>
        <td>{{ e.prix_minimale }} $</td>
        <td>{{ e.date_debut|date("d/m/Y H:i") }}</td>
        <td>{{ e.date_fin|date("d/m/Y H:i") }}</td>
        <td>
          {% if e.statut_enchere == 1 %}
          En cours
          {% elseif e.statut_enchere == 2 %}
          Terminée
          {% else %}
          Inconnu
          {% endif %}
        </td>
        <td>{{ e.coup_de_coeur ? '' : '—' }}</td>
        <td class="action-buttons">
          <a href="{{ base }}/enchere/edit?id={{ e.id }}"><button>Modifier</button></a>
          <a href="{{ base }}/enchere/delete?id={{ e.id }}"><button class="btn btn-danger" onclick="return confirm('Supprimer cette enchère ?')">Supprimer</button></a>
        </td>
      </tr>
      {% endfor %}
    </tbody>
  </table>
  {% else %}
  <p colspan="8">Aucune enchère trouvée.</p>
  {% endif %}
</div>


{% include 'layouts/footer.php' %}