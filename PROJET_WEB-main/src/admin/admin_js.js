  // Variable globale pour stocker l'ID de l'utilisateur à supprimer
  var userIdToDelete;

//suppimer un user popup
function confirmDelete(userId) {
    if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?")) {
        window.location.href = "admin.php?id=" + userId + "&action=delete";
    }
}

// Fonction pour afficher la fenêtre modale de confirmation de suppression
function afficherModal(userId) {
  var modal = document.getElementById("modalConfirmation");
  modal.style.display = "block";
  // Enregistrer l'ID de l'utilisateur à supprimer dans la variable globale
  userIdToDelete = userId;
}

// Fonction pour fermer la fenêtre modale
function fermerModal() {
  var modals = document.querySelectorAll(".modal");
  modals.forEach(function(modal) {
      modal.style.display = "none";
  });
}

// Fonction pour supprimer l'utilisateur
function supprimerUtilisateur(userId) {
  // Effectuer l'action de suppression ici
  // Afficher la fenêtre modale de confirmation réussie
  fermerModal(); // Fermer le premier pop-up
  var modalConfirmationReussie = document.getElementById("modalConfirmationReussie");
  modalConfirmationReussie.style.display = "block"; // Afficher le deuxième pop-up
}


  // Fonction appelée lors de la confirmation de suppression dans la fenêtre modale
function confirmerSuppression() {
  var modalConfirmation = document.getElementById("modalConfirmation");
  var userId = modalConfirmation.getAttribute("data-user-id");

  // Appeler la fonction de suppression avec l'ID de l'utilisateur
  supprimerUtilisateur(userId);

  // Fermer la fenêtre modale de confirmation
  fermerModal();

  // Afficher la fenêtre modale de suppression réussie si nécessaire
  var modalConfirmationReussie = document.getElementById("modalConfirmationReussie");
  modalConfirmationReussie.style.display = "block";
}

function editUser(userId) {
    window.location.href = "edit_user.php?id=" + userId;
}


// Obtenir la référence à tous les boutons "Supprimer"
var deleteButtons = document.querySelectorAll('.deleteBtn');

// Attacher un gestionnaire d'événement à chaque bouton "Supprimer"
deleteButtons.forEach(function(button) {
  button.addEventListener('click', function() {
    var userId = this.dataset.userId;
    var modal = document.getElementById("myModal_" + userId);
    modal.style.display = "block";
  });
});

// Fermer la boîte de dialogue lorsque l'utilisateur clique sur l'icône de fermeture (X) ou le bouton "Annuler"
var closeButtons = document.querySelectorAll('.close, .cancelBtn');
closeButtons.forEach(function(button) {
  button.addEventListener('click', function() {
    var modal = this.closest('.modal');
    modal.style.display = "none";
  });
});

// Gérer la logique de suppression lorsque l'utilisateur clique sur le bouton "Confirmer"
var confirmButtons = document.querySelectorAll('.confirmBtn');
confirmButtons.forEach(function(button) {
  button.addEventListener('click', function() {
    // Insérer ici la logique de suppression
    var userId = this.closest('.modal').id.replace('myModal_', '');
    window.location.href = "admin.php?id=" + userId + "&action=delete";
  });
});


//Pop up modification réussie 
function UserModifier() {
  alert("Les informations de l'utilisateur ont été mises à jour avec succès.");
}

function editUser(userId) {
  window.location.href = "edit_user.php?id=" + userId;
}

// Fonction pour rediriger l'utilisateur après avoir fermé la fenêtre modale de confirmation réussie
function redirectToDeletePage() {
  // Rediriger l'utilisateur vers la page de suppression avec l'ID de l'utilisateur
  window.location.href = "admin.php?action=delete&id=" + userIdToDelete;
}

// Fonction pour afficher le pop-up de modification réussie
function afficherModificationReussieModal() {
  var modal = document.getElementById("modificationReussieModal");
  modal.style.display = "block";
}

// Fonction pour fermer le pop-up de modification réussie
function fermerModificationReussieModal() {
  document.getElementById("fermerPopup").addEventListener("click", function() {
    fermerModal('modificationReussieModal');
    document.querySelector(".cadre1").submit();
  });
}
