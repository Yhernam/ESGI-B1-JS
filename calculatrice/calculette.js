//recupere le bouton
//appelle d'une fonction annonyme en second parametre d'une autre fonction:
// const addButton = document.getElementById("add");
// addButton.onclick("click", function () {
//     alert("click");
// });

// const sousButton = document.getElementById("sous");
// sousButton.onclick("click", function () {
//     alert("click");
// });

// const multiButton = document.getElementById("multi");
// multiButton.onclick("click", function () {
//     alert("click");
// });

let nb1 = document.getElementById("a");
let nb2 = document.getElementById("b");
let resultat = document.getElementById("submit");

const addition = function (nb1, nb2) {
    document.getElementById("add").onclick("click", function() {
        resultat = nb1 + nb2;
        return resultat;
    });
}
const soustraction = function (nb1, nb2) {
    document.getElementById("sous").onclick("click", function() {
        resultat = nb1 - nb2;
        return resultat;
    });
}
const multiplication = function (nb1, nb2) {
    document.getElementById("multi").onclick("click", function() {
        resultat = nb1 * nb2;
        return resultat;
    });
}

let result = () => {
    document.getElementById("calc").onclick("click", function () {
        console.log(resultat);
    });
}