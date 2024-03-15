document.querySelector("#search").addEventListener("click", getPokemon);

function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

function lowerCaseName(string) {
  return string.toLowerCase();
}

function getPokemon(e) {
  const name = document.querySelector("#pokemonName").value;
  const pokemonName = lowerCaseName(name);

  fetch(`https://pokeapi.co/api/v2/pokemon/${pokemonName}`)
    .then((response) => response.json())
    .then((data) => {
      document.querySelector(".pokemonBox").innerHTML = `
      <div>
        <img
          src="${data.sprites.other["official-artwork"].front_default}"
          alt="Pokemon name"
        />
      </div>
      <div class="pokemonInfos">
        <h1>${capitalizeFirstLetter(data.name)}</h3>
        <p>Weight: ${data.weight}</p>
      </div>`;
    })
    .catch((err) => {
      document.querySelector(".pokemonBox").innerHTML = `
      <h4>Pokemon not found 😞</h4>
      `;
      console.log("Pokemon not found", err);
    });

  e.preventDefault();
}







/*
ID=""
let ApiUrl=`https://pokeapi.co/api/v2/pokemon/`

function changeApi() {
    ID = document.getElementById("submit").value;
    ApiUrl = `https://pokeapi.co/api/v2/pokemon/${ID}/`

}

fetch= ApiUrl;


function GetApi() {


let outputElement = document.getElementById('output');

// requête GET
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
*/