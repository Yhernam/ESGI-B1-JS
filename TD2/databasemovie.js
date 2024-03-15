
  document.addEventListener("DOMContentLoaded", () => {
    const filmsListElement = document.getElementById("films-list");
    const filmDetailsElement = document.getElementById("film-details");
    // Fonction pour afficher la liste des films
    function afficherListeFilms() {
      fetch("https://swapi.dev/api/films/")
        .then((response) => response.json())
        .then((data) => {
          data.results.forEach((film) => {
            const li = document.createElement("li");
            li.textContent = film.title;
            li.style.cursor = "pointer";
            li.addEventListener("click", () =>
  afficherDetailsFilm(film.url));
            filmsListElement.appendChild(li);
        }); })
        .catch((error) =>
          console.error("Erreur lors de la récupération des films :", error)
  ); }
    // Fonction pour afficher les détails d'un film sélectionné
    function afficherDetailsFilm("https://swapi.dev/api/films/") {
      fetch("https://swapi.dev/api/films/")
        .then((response) => response.json())
        .then((film) => {
          filmDetailsElement.innerHTML = `
                      <h2>${film.title}</h2>
                      <p><strong>Date de sortie :</strong>
  ${film.release_date}</p>
                      <p><strong>Réalisateur :</strong> ${film.director}</p>
                      <p><strong>Producteurs :</strong> ${film.producer}</p>
                      <p><strong>Résumé :</strong> ${film.opening_crawl}</p>
  `; })
        .catch((error) =>
          console.error(
            "Erreur lors de la récupération des détails du film :",
  error )
  ); }
    afficherListeFilms();
  });