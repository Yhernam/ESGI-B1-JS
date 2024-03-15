document.addEventListener("DOMContentLoaded", () => {
    const filmsListElement = document.getElementById("films-list");
    const filmDetailsElement = document.getElementById("film-details");

    function afficherListeFilms() {
        fetch("https://swapi.py4e.com/api/films/")
            .then(response => response.json())
            .then(data => {
                data.results.forEach(film => {
                    const li = document.createElement("li");
                    li.textContent = film.title;
                    li.style.cursor = "pointer";
                    li.addEventListener("click", () =>
                        afficherDetailsFilm(film.url)
                    );
                    filmsListElement.appendChild(li);
                });
            })
            .catch(error =>
                console.error("Erreur lors de la récupération des films :", error)
            );
    }

    function afficherDetailsFilm(url) {
        fetch(url)
            .then(response => response.json())
            .then(film => {
                filmDetailsElement.innerHTML = `<h2>${film.title}</h2>
                <p><strong>Date de sortie :</strong> ${film.release_date}</p>
                <p><strong>Réalisateur :</strong> ${film.director}</p>
                <p><strong>Producteurs :</strong> ${film.producer}</p>
                <p><strong>Résumé :</strong> ${film.opening_crawl}</p>`;
                afficherPersonnagesFilm(film.characters);
            })
            .catch(error =>
                console.error(
                    "Erreur lors de la récupération des détails du film :",
                    error
                )
            );
    }


    async function afficherPersonnagesFilm(characterUrls) {
        const characterNames = [];
        for (const url of characterUrls) {
            const response = await fetch(url);
            const character = await response.json();
            characterNames.push(character.name);
        }
        filmDetailsElement.innerHTML += `<p><strong>Nom des Personnages :</strong> ${characterNames.join(", ")}</p>`;
    }

    afficherListeFilms();
});
