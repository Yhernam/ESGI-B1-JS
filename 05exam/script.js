function changeApi() { 
    ID = document.getElementById("recherche").value;
    ApiUrl = `https://pokeapi.co/api/v2/pokemon/${ID}/`

}
fetch= ApiUrl;


// Make a GET request
fetch(ApiUrl)
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    JSonMcData = data
    mcData = JSON.stringify(JSonMcData);
    outputElement.textContent =  mcData.online + ", " + mcData.ip + ", " + mcData.hostname + ", " + mcData.version + ", " + mcData.players.online
  })
  .catch(error => {
    console.error('Error:', error);
  });

}