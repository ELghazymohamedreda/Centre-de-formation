CREATE TABLE Formateur (
  id_formateur INTEGER PRIMARY KEY,
  nom TEXT,
  prenom TEXT,
  email TEXT,
  mot_de_passe TEXT
);

CREATE TABLE Apprenant (
  id_apprenant INTEGER PRIMARY KEY,
  nom TEXT,
  prenom TEXT,
  email TEXT,
  mot_de_passe TEXT
);

CREATE TABLE Formation (
  id_formation INTEGER PRIMARY KEY,
  categorie TEXT,
  description TEXT,
  masse_horaire INTEGER,
  sujet TEXT
);

CREATE TABLE Session (
  id_session INTEGER PRIMARY KEY,
  date_debut DATE,
  date_fin DATE,
  nombre_de_places INTEGER,
  etat TEXT,
  id_formation INTEGER,
  id_formateur INTEGER,
  FOREIGN KEY (id_formation) REFERENCES Formation(id_formation),
  FOREIGN KEY (id_formateur) REFERENCES Formateur(id_formateur)
);

CREATE TABLE Evaluation (
  id_session INTEGER,
  id_apprenant INTEGER,
  date_evaluation DATE,
  PRIMARY KEY (id_session, id_apprenant),
  FOREIGN KEY (id_session) REFERENCES Session(id_session),
  FOREIGN KEY (id_apprenant) REFERENCES Apprenant(id_apprenant)
);
