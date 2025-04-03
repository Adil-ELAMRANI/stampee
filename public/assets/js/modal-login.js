//console.log(" modal-login.js chargé");

document.addEventListener("DOMContentLoaded", function () {
  const btnConnexion = document.getElementById("btn-connexion");
  const modal = document.getElementById("modal-connexion");

  if (!btnConnexion) {
    //console.log(" Icône (btn-connexion) introuvable !");
    return;
  }
  if (!modal) {
    //console.log(" Modale (modal-connexion) introuvable !");
    return;
  }

  //console.log(" Tous les éléments sont présents");

  const closeBtn = modal.querySelector(".close");
  if (!closeBtn) {
    //console.log(" Bouton de fermeture introuvable !");
  }

  btnConnexion.addEventListener("click", function (e) {
    e.preventDefault();
    //console.log(" Icône cliquée !");
    modal.classList.remove("hidden");
  });

  if (closeBtn) {
    closeBtn.addEventListener("click", function () {
      modal.classList.add("hidden");
    });
  }

  window.addEventListener("click", function (e) {
    if (e.target === modal) {
      modal.classList.add("hidden");
    }
  });

  // Gestion du switch entre login et inscription
  const switchToRegister = document.getElementById("switch-to-register");
  const switchToLogin = document.getElementById("switch-to-login");
  const formLogin = document.getElementById("form-login");
  const formRegister = document.getElementById("form-register");

  if (switchToRegister && switchToLogin && formLogin && formRegister) {
    switchToRegister.addEventListener("click", (e) => {
      e.preventDefault();
      formLogin.classList.add("hidden");
      formRegister.classList.remove("hidden");
    });

    switchToLogin.addEventListener("click", (e) => {
      e.preventDefault();
      formRegister.classList.add("hidden");
      formLogin.classList.remove("hidden");
    });
  }
});
