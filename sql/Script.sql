DROP TABLE IF EXISTS Oeuvre_Genre;
DROP TABLE IF EXISTS Oeuvre_Langue;
DROP TABLE IF EXISTS Oeuvre_Personne;
DROP TABLE IF EXISTS Oeuvre_Appreciation;
DROP TABLE IF EXISTS Utilisateur_Favori;
DROP TABLE IF EXISTS Oeuvre;
DROP TABLE IF EXISTS Appreciation;
DROP TABLE IF EXISTS Genre;
DROP TABLE IF EXISTS Langue;
DROP TABLE IF EXISTS Personne;
DROP TABLE IF EXISTS Utilisateur;

CREATE TABLE Utilisateur (
Id INTEGER PRIMARY KEY AUTOINCREMENT ,
Identifiant TEXT UNIQUE NOT NULL,
MotDePasse TEXT NOT NULL 
);

CREATE TABLE Personne (
Id INTEGER PRIMARY KEY AUTOINCREMENT,
Nom TEXT UNIQUE NOT null,
Prenom TEXT UNIQUE NOT NULL
);

CREATE TABLE Langue (
Id INTEGER PRIMARY KEY AUTOINCREMENT,
NomLangue TEXT UNIQUE NOT NULL
);

CREATE TABLE Genre (
Id INTEGER PRIMARY KEY AUTOINCREMENT,
NomGenre TEXT UNIQUE NOT NULL
);

CREATE TABLE Appreciation (
Id INTEGER PRIMARY KEY AUTOINCREMENT,
IdUtil integer,
Commentaire TEXT NOT NULL,
Note decimal not NULL,
foreign key (IdUtil) references Utilisateur(Id)
);

CREATE TABLE Oeuvre (
Id INTEGER PRIMARY KEY AUTOINCREMENT,
Titre TEXT not null,
Annee INTEGER not null,
Temps INTEGER not null,
Description TEXT,
Affiche TEXT,
TypeOeuvre TEXT not null, 
Pays TEXT not null
);

CREATE TABLE Oeuvre_Genre (
IdOeuvre INTEGER,
IdGenre INTEGER,
foreign key (IdOeuvre) references Oeuvre(Id),
foreign key (IdGenre) references Genre(Id)
);

CREATE TABLE Oeuvre_Langue (
IdOeuvre INTEGER,
IdLangue INTEGER,
foreign key (IdOeuvre) references Oeuvre(Id),
foreign key (IdLangue) references Langue(Id)
);

CREATE TABLE Oeuvre_Personne (
IdOeuvre INTEGER,
IdPersonne INTEGER,
foreign key (IdOeuvre) references Oeuvre(Id),
foreign key (IdPersonne) references Personne(Id)
);

CREATE TABLE Oeuvre_Appreciation (
IdOeuvre INTEGER,
IdAppreciation INTEGER,
foreign key (IdOeuvre) references Oeuvre(Id),
foreign key (IdAppreciation) references Appreciation(Id)
);
CREATE TABLE Utilisateur_Favori (
IdOeuvre INTEGER,
IdUtilisateur INTEGER,
foreign key (IdOeuvre) references Oeuvre(Id),
foreign key (IdUtilisateur) references Utilisateur(Id)
);

