// Cette fonction envoie les données d'un nouveau ticket au serveur, les ajoute à la table HTML, puis recharge la page pour afficher les mises à jour
function submitTicket() {
    const type = document.getElementById("types").value;
    const date = document.getElementById("dateInput").value;
    const somme = document.getElementById("prixInput").value;
    const etat = "En attente de traitement";

    if (!type || !date || !somme) {
        alert("Veuillez remplir tous les champs !");
        return; // Arrête la fonction si un champ est vide
    }

    var xhr = new XMLHttpRequest();
    var url = "ajout_ticket.php";
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse du script PHP si nécessaire
            console.log(xhr.responseText);
            location.reload();
        }
    };

    // Ajout du ticket dans le tableau côté client
    if (!type || !date || !somme) {
        alert("Veuillez remplir tous les champs !");
        return; // Arrête la fonction si un champ est vide
    } else {
        const newRow = document.getElementById("ticketBody").insertRow();
        
        newRow.insertCell(0).textContent = "";
        newRow.insertCell(1).textContent = etat;
        newRow.insertCell(2).textContent = type;
        newRow.insertCell(3).textContent = date;
        newRow.insertCell(4).textContent = somme;
        
        // Envoyer les données au script PHP
        xhr.send("type=" + type + "&date=" + date + "&somme=" + somme + "&etat=" + etat);
        
        const cellModifier = newRow.insertCell(5);
        const btnModifier = document.createElement("button");
        btnModifier.textContent = "Modifier";
        btnModifier.onclick = function() {
            displayTicket(newRow);
            location.reload();
        };
        cellModifier.appendChild(btnModifier);
        togglePopup();
    }
    location.reload();
}

// Cette fonction sert à afficher ou masquer une fenêtre popup du ticket sur la page web
function togglePopup() {
    let popup = document.querySelector("#popup-overlay");
    popup.classList.toggle("open");
    if (!popup.classList.contains("open")) {
        reset_popup();
    }
}

// Réinitialise les champs du formulaire de la fenêtre contextuelle à leurs valeurs par défaut
function reset_popup() {
    document.getElementById("types").value = "";
    document.getElementById("dateInput").value = "";
    document.getElementById("prixInput").value = "";
}

// Affiche les détails d'un ticket existant dans la fenêtre contextuelle pour modification, récupérant les données de la ligne de la table HTML sélectionnée
function displayTicket(row) {
    const cellules = row.cells;
    const id_facture = cellules[0].textContent;
    const etat = cellules[1].textContent;

    document.getElementById("types").value = cellules[2].textContent;
    document.getElementById("dateInput").value = cellules[3].textContent;
    document.getElementById("prixInput").value = cellules[4].textContent;

    const btnModifier = document.getElementById("btnModifier");
    if (etat != "En attente de traitement") {
        btnModifier.disabled = true;
    } else {
        btnModifier.disabled = false;
    }
    
    btnModifier.onclick = function() {
        modification(id_facture);
    };
    togglePopup();
}

//  Envoie les modifications d'un ticket existant au serveur via une requête AJAX et affiche le ticket mis à jour après une mise à jour réussie.
function modification(id_facture) {
    const nouveauType = document.getElementById("types").value;
    const nouvelleDate = document.getElementById("dateInput").value;
    const nouveauPrix = document.getElementById("prixInput").value;

    if (!nouveauPrix || !nouvelleDate || !nouveauType) {
        alert("Veuillez remplir tous les champs !");
        return; // Arrête la fonction si un champ est vide
    } else {
        var xhr = new XMLHttpRequest();
        var url = "update_ticket.php";
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                displayTicket()
                location.reload();
            }
        };
        var params = "id_facture=" + id_facture + "&type=" + nouveauType + "&date=" + nouvelleDate + "&somme=" + nouveauPrix;
        xhr.send(params);
        togglePopup();
        location.reload();
    }
}

//  Écoute les clics sur la page pour détecter si l'utilisateur souhaite modifier un ticket existant, déclenchant alors l'affichage des détails du ticket dans la fenêtre contextuelle.
document.addEventListener("click", function(event) {
    if (event.target.classList.contains("btn-modifier")) {
        let row = event.target.closest("tr");
        displayTicket(row);
    }
});

// Cette fonction supprime un ticket de la base de données et actualise la page après confirmation de la suppression
function deleteTicket(id_facture) {
    var confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce ticket ?");
    if (confirmation) {
        var xhr = new XMLHttpRequest();
        var url = "delete_ticket.php";
        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                // Vérifiez si l'élément avec l'ID id_facture existe
                var row = document.getElementById(id_facture);
                if (row) {
                    // Supprimer la ligne du ticket de l'interface utilisateur
                    console.log("Supprimer l'élément avec l'ID:", id_facture);
                    row.parentNode.removeChild(row);
                }
            }
        };
        var params = "id_facture=" + id_facture;
        xhr.send(params);
    }
    location.reload();
}
