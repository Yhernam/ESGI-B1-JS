ID=""
let ApiUrl=`https://pokeapi.co/api/v2/pokemon/`

function changeApi() {
    ID = document.getElementById("recherche").value;
    ApiUrl = `https://pokeapi.co/api/v2/pokemon/${ID}/`

}

fetch= ApiUrl;

function GetApi() {
let outputElement = document.getElementById('output');


// Make a GET request
fetch(ApiUrl)
  .then(response => {
    if (!response.ok) {
      throw new Error('Error Network');
    }
    return response.json();
  })
  .then(pokemon => {
    Pokedex = pokemon
    Pokestr = JSON.stringify(Pokedex);
    outputElement.textContent =  Pokestr.online + ", " + Pokestr.ip + ", " + Pokestr.hostname + ", " + Pokestr.version + ", " + Pokestr.players.online
  })
  .catch(error => {
    console.error('Error:', error);
  });
}