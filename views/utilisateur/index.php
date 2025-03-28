{% include 'layouts/header.php' %}

<main class="main-container">
  <h1>Liste des utilisateurs</h1>

  <div class="actions-top">
    <a href="{{ base }}/utilisateur/create">
      <button>Ajouter un utilisateur</button>
    </a>
  </div>

  {% if utilisateurs is empty %}
  <p>Aucun utilisateur enregistré pour le moment.</p>
  {% else %}
  <table class="table-crud">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Email</th>

        <th>Nom d'utilisateur</th>
        <th>Adresse</th>
        <th>Privilège</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      {% for u in utilisateurs %}
      <tr>
        <td data-label="Nom">{{ u.nom }}</td>
        <td data-label="Email">{{ u.email }}</td>
        <td data-label="Nom d'utilisateur">{{ u.nom_utilisateur }}</td>
        <td data-label="Adresse">{{ u.adresse }}</td>
        <td data-label="Privilège">{{ u.privilege_id }}</td>
        <td data-label="Actions">
          <div class="action-buttons">
            <a href="{{ base }}/utilisateur/edit?id={{ u.id }}">
              <button>Modifier</button>
            </a>
            <a href="{{ base }}/utilisateur/delete?id={{ u.id }}" onclick="return confirm('Supprimer cet utilisateur ?')">
              <button>Supprimer</button>
            </a>
          </div>
        </td>
      </tr>
      {% endfor %}
    </tbody>
  </table>
  {% endif %}
</main>

{% include 'layouts/footer.php' %}