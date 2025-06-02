const donnees = [
  { titre: "Breaking Bad", description: "Un professeur de chimie devient fabricant de drogue." },
  { titre: "Inception", description: "Un voleur infiltre les rêves pour voler des secrets." },
  { titre: "Le Seigneur des anneaux - Le Retour du roi", description: "C'est l'histoire d'un mec qui était à un doigt de garder l'anneau." },
  { titre: "Panic Room", description: "Parce qu'il a fallu que la gamine soit diabétique." },
  { titre: "Titanic", description: "Un film qui parle de la fourberie des glaçons." },
  { titre: "Forrest Gump", description: "C'est l'histoire d'un mec sur un banc qui raconte sa life en bouffant des chocolats." },
  { titre: "Conjuring", description: "C'est l'histoire d'une voisine relou qui se sert de sa cape d'invisibilité pour pourrir les parties de cache-cache." },
  { titre: "Terminator", description: "C’est l’histoire d’un mec qui veut tes vêtements tes bottes et ta moto, et qui traque des Sarah Connor." },
  { titre: "La Nuit au musée", description: "C'est un mec qui passe la nuit au musée." },
  { titre: "Spider-Man", description: "Un film qui parle de la fourberie des glaçons." },
  { titre: "Rubber", description: "C'est l'histoire d'un pneu badass qui tue des gens, évolue et forme un gang." },
  { titre: "Shrek", description: "Un ogre antisocial se fait des potes malgré lui et sauve une princesse, parce que pourquoi pas." },
  { titre: "The Matrix", description: "Un informaticien découvre que la réalité est un bug et qu’il est le seul à pouvoir faire Alt + F4 dessus."}
]

const rechercheChamps = document.getElementById('rechercheChamps');
const catalogue = document.getElementById('catalogue');
const modale = document.getElementById('modale');
const modaleTitre = document.getElementById('modaleTitre');
const modalDescription = document.getElementById('modalDescription');
const modaleFermee = document.getElementById('modaleFermee');
const pagination = document.getElementById('pagination');

let pageCourante = 1;
const maxParPage = 10;

function AfficheCatalogue(films) {
  catalogue.innerHTML = "";
  const deb = (pageCourante - 1) * maxParPage;
  const filmsPagines = films.slice(deb, deb + maxParPage);

  filmsPagines.forEach(film => {
    const carre = document.createElement('div');
    carre.className = 'carre';
    carre.innerHTML = `
      <h3>${film.titre}</h3>
      <p>${film.description.slice(0, 50)}...</p>
      <button onclick="AfficheDetails('${film.titre}', \`${film.description}\`)">Voir</button>
    `;
    catalogue.appendChild(carre);
  });
}

function AfficheDetails(titre, description) {
  modaleTitre.textContent = titre;
  modalDescription.textContent = description;
  modale.classList.remove('hidden');
}

modaleFermee.onclick = () => modale.classList.add('hidden');
window.onclick = (e) => {
  if (e.target === modale) modale.classList.add('hidden');
};

function MajPagination(films) {
  pagination.innerHTML = "";
  const nbPAge = Math.ceil(films.length / maxParPage);

  for (let i = 1; i <= nbPAge; i++) {
    const btn = document.createElement('button');
    btn.textContent = i;
    if (i === pageCourante) btn.style.backgroundColor = '#666';
    btn.onclick = () => {
      pageCourante = i;
      AfficheCatalogue(films);
      MajPagination(films);
    };
    pagination.appendChild(btn);
  }
}

function searchItems() {
  const requete = rechercheChamps.value.toLowerCase();
  const filtres = donnees.filter(item => item.titre.toLowerCase().includes(requete));
  pageCourante = 1;
  AfficheCatalogue(filtres);
  MajPagination(filtres);

  if (filtres.length === 0) {
    catalogue.innerHTML = "<p>Aucun résultat trouvé.</p>";
    pagination.innerHTML = "";
  }
}

rechercheChamps.addEventListener('input', searchItems);

// Initial Load
AfficheCatalogue(donnees);
MajPagination(donnees);
