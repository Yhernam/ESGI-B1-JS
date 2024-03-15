document.addEventListener("DOMContentLoaded", function () {
  fetch("https://swapi.dev/api/films")
    .then((response) => response.json())
    .then((data) => {
      createFilmList(data.results);
    })
    .catch((error) =>
      console.error("Erreur lors de la récupération des films:", error)
    );

  function displayFilmDetails(film) {
    document.getElementById("title").textContent = film.title;
    document.getElementById("opening-crawl").textContent = film.opening_crawl;
    document.getElementById("release-date").textContent = film.release_date;
    document.getElementById("director").textContent = film.director;
    document.getElementById("producers").textContent = film.producer;
  }

  function createFilmList(films) {
    const filmList = document.getElementById("film-list");

    films.forEach((film) => {
      const li = document.createElement("li");
      const link = document.createElement("a");

      link.textContent = `${film.title} (${film.release_date})`;
      link.href = "#"; // Ajoutez le lien vers la page détaillée du film si nécessaire

      // Ajoutez un gestionnaire d'événements pour afficher les détails du film au clic
      link.addEventListener("click", function () {
        displayFilmDetails(film);
      });

      li.appendChild(link);
      filmList.appendChild(li);
    });
  }
});
// fetch("https://swapi.dev/api/films")
//.then((response)=> response.json())
//.then((response)=> console.log(response))
//.catch((err)=>  console.error(err))


//document.addEventListener("DOMContentLoaded", function () {
//fetch("https://swapi.dev/api/films")
 // .then((response) => response.json())
 // .then((film) => {
   // document.getElementById("title").textContent = film.title;
   // document.getElementById("opening-crawl").textContent = film.opening_crawl;
   // document.getElementById("release-date").textContent = film.release_date;
   // document.getElementById("director").textContent = film.director;
   // document.getElementById("producers").textContent = film.producer;
 // })
 // .catch((error) =>
  //  console.error(
 //     "Erreur lors de la récupération des détails du film:",
//error )
//); });