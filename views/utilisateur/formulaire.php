<form method="post" action="{{ base }}/utilisateur/{{ utilisateur.id is defined ? 'update' : 'create' }}">
  <input type="hidden" name="id" value="{{ utilisateur.id|default('') }}">

  <label for="nom">Nom complet</label>
  <input type="text" id="nom" name="nom" value="{{ utilisateur.nom|default('')|e }}" required>
  <span class="error">{{ errors.nom ?? '' }}</span>

  <label for="nom_utilisateur">Nom utilisateur</label>
  <input type="text" id="nom_utilisateur" name="nom_utilisateur"
         value="{{ utilisateur.nom_utilisateur|default('')|e }}"
         {% if utilisateur.id is defined %}disabled{% endif %} required>
  <span class="error">{{ errors.nom_utilisateur ?? '' }}</span>

  <label for="email">Email</label>
  <input type="email" id="email" name="email" value="{{ utilisateur.email|default('')|e }}" required>
  <span class="error">{{ errors.email ?? '' }}</span>

  <label for="mot_de_passe">Mot de passe</label>
  <input type="password" id="mot_de_passe" name="mot_de_passe" {{ utilisateur.id is defined ? '' : 'required' }}>
  <span class="error">{{ errors.mot_de_passe ?? '' }}</span>

  <label for="adresse">Adresse</label>
  <input type="text" id="adresse" name="adresse" value="{{ utilisateur.adresse|default('')|e }}" required>
  <span class="error">{{ errors.adresse ?? '' }}</span>

  <label for="privilege_id">Privilège</label>
  <select name="privilege_id" id="privilege_id" required>
    {% for p in privileges %}
      <option value="{{ p.id }}" {% if utilisateur.privilege_id == p.id %}selected{% endif %}>
        {{ p.privilege }}
      </option>
    {% endfor %}
  </select>
  <span class="error">{{ errors.privilege_id ?? '' }}</span>

  <button type="submit" class="btn">
    {{ utilisateur.id is defined ? 'Mettre à jour' : 'Créer' }}
  </button>
</form>
