{{ include('layouts/header.php', {title: 'Connexion'}) }}

<div class="container">
    {% if errors is defined %}
    <div class="error">
        <ul>
            {% for error in errors %}
            <li>{{ error }}</li>
            {% endfor %}
        </ul>
    </div>
    {% endif %}

    <form method="post" class="form-auth">
        <h2>Connexion</h2>

        <label for="nom_utilisateur">Nom d'utilisateur</label>
        <input type="text" id="nom_utilisateur" name="nom_utilisateur" value="{{ utilisateur.nom_utilisateur|default('') }}" placeholder="Votre nom d'utilisateur" required>

        <label for="mot_de_passe">Mot de passe</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="********" required>

        <input type="submit" class="btn" value="Se connecter">
    </form>
</div>

{{ include('layouts/footer.php') }}