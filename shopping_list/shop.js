const basket = [];

function addBasket(newfruit) {
    basket.push(newfruit);
    updateBasket();
}

function updateBasket() {
    var table = document.getElementById("panier");
    table.innerHTML = "<tr><th>Éléments</th></tr>";

    for (var i = 0; i < basket.length; i++) {
        var row = table.insertRow(i + 1);
        var cell = row.insertCell(0);
        cell.innerHTML = basket[i];
    }
}

function afficherPanier() {
    var panierText = "Panier : " + basket.join(", ");
    alert(panierText);
}




fetch("https://swapi.dev/api/films/1/")
.then((response)=> response.json())
.then((response)=> console.log(response))
.catch((err)=>  console.error(err))
