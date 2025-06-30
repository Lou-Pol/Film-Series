const API_KEY = "9126aebd"; 
const rechercheChamps = document.getElementById("rechercheChamps");
const catalogue = document.getElementById("catalogue");
const modale = document.getElementById("modale");
const modaleTitre = document.getElementById("modaleTitre");
const modalDescription = document.getElementById("modalDescription");
const modaleFermee = document.getElementById("modaleFermee");
const pagination = document.getElementById("pagination");


const filtreType = document.createElement("select");
const filtreAnnee = document.createElement("input");

filtreType.innerHTML = `
  <option value="">Tous</option>
  <option value="movie">Films</option>
  <option value="series">Séries</option>
`;
filtreAnnee.type = "number";
filtreAnnee.placeholder = "Année";

rechercheChamps.insertAdjacentElement("afterend", filtreType);
filtreType.insertAdjacentElement("afterend", filtreAnnee);

let pageCourante = 1;
const maxParPage = 10;
let dernierMotCle = "";
let dernierResultat = [];

async function rechercheOMDb(motCle, page = 1) {
  const type = filtreType.value;
  const annee = filtreAnnee.value;

  let url = `https://www.omdbapi.com/?apikey=${API_KEY}&s=${encodeURIComponent(motCle)}&page=${page}`;
  if (type) url += `&type=${type}`;
  if (annee) url += `&y=${annee}`;

  try {
    const response = await fetch(url);
    const data = await response.json();

    if (data.Response === "True") {
      return {
        totalResults: parseInt(data.totalResults),
        films: data.Search,
      };
    } else {
      return { totalResults: 0, films: [] };
    }
  } catch (error) {
    console.error("Erreur API:", error);
    return { totalResults: 0, films: [] };
  }
}

async function chargerResultats(motCle, page = 1) {
  catalogue.innerHTML = "<p>Chargement...</p>";
  const resultats = await rechercheOMDb(motCle, page);
  dernierMotCle = motCle;
  dernierResultat = resultats;
  pageCourante = page;

  if (resultats.films.length === 0) {
    catalogue.innerHTML = "<p>Aucun résultat trouvé.</p>";
    pagination.innerHTML = "";
    return;
  }

  afficherCatalogue(resultats.films);
  majPagination(resultats.totalResults);
}

function afficherCatalogue(films) {
  catalogue.innerHTML = "";
  films.forEach((film) => {
    const carre = document.createElement("div");
    carre.className = "carre";
    carre.innerHTML = `
      <h3>${film.Title}</h3>
      <img src="${film.Poster !== "N/A" ? film.Poster : "https://via.placeholder.com/150"}" alt="Affiche" />
      <p>${film.Year} - ${film.Type}</p>
      <button onclick="voirDetails('${film.imdbID}')">Voir</button>
    `;
    catalogue.appendChild(carre);
  });
}

function majPagination(totalResults) {
  pagination.innerHTML = "";
  const nbPages = Math.ceil(totalResults / maxParPage);

  for (let i = 1; i <= nbPages; i++) {
    const btn = document.createElement("button");
    btn.textContent = i;
    if (i === pageCourante) btn.style.backgroundColor = "#666";
    btn.onclick = () => chargerResultats(dernierMotCle, i);
    pagination.appendChild(btn);
  }
}

async function voirDetails(imdbID) {
  try {
    const response = await fetch(`https://www.omdbapi.com/?apikey=${API_KEY}&i=${imdbID}&plot=full`);
    const film = await response.json();

    modaleTitre.textContent = film.Title;
    modalDescription.innerHTML = `
      <strong>Année :</strong> ${film.Year}<br>
      <strong>Durée :</strong> ${film.Runtime}<br>
      <strong>Genre :</strong> ${film.Genre}<br>
      <strong>Acteurs :</strong> ${film.Actors}<br>
      <strong>Synopsis :</strong> ${film.Plot}
    `;

    document.getElementById("champTitre").value = film.Title;
    document.getElementById("champAnnee").value = film.Year;
    document.getElementById("champTemps").value = film.Runtime;
    document.getElementById("champType").value = film.Type;
    document.getElementById("champPays").value = film.Country;
    document.getElementById("champAffiche").value = film.Poster;
    document.getElementById("champDescription").value = film.Plot;
    

    modale.classList.remove("hidden");
  } catch (err) {
    console.error("Erreur lors du chargement des détails:", err);
  }
}


modaleFermee.onclick = () => modale.classList.add("hidden");
window.onclick = (e) => {
  if (e.target === modale) modale.classList.add("hidden");
};

rechercheChamps.addEventListener("input", () => {
  if (rechercheChamps.value.trim().length >= 3) {
    chargerResultats(rechercheChamps.value.trim());
  }
});
filtreType.addEventListener("change", () => chargerResultats(rechercheChamps.value.trim()));
filtreAnnee.addEventListener("input", () => chargerResultats(rechercheChamps.value.trim()));


catalogue.innerHTML = "<p>Entrez un mot-clé pour commencer la recherche.</p>";
