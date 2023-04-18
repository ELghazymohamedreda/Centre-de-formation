-- Create table for Apprenants
CREATE TABLE apprenants (
   `id_apprenant` INT PRIMARY KEY,
    `nom_apprenant` VARCHAR(50),
    `prenom_apprenant` VARCHAR(50),
    `email_apprenant` VARCHAR(50),
    `mot_de_pass` VARCHAR(50),
    CONSTRAINT email_unique UNIQUE (`email_apprenant`)
);

-- Create table for Sessions
CREATE TABLE sessions (
    `id_session` INT PRIMARY KEY,
    `date_debut` DATE,
    `date_fin` DATE,
    `etat` VARCHAR(50),
    `nombre_de_place` INT,
    `id_formation` INT,
    `id_formateur` INT
      FOREIGN KEY (`id_formation`) REFERENCES formation (`id_formation`),
    FOREIGN KEY (`id_formateur`) REFERENCES Formateurs (`id_formateur`)
);

-- Create table for Inscription
CREATE TABLE inscription (
    `id_apprenant` INT,
    `id_session` INT,
    `resultat` VARCHAR(50),
    `date_valu` DATE,
    PRIMARY KEY (`id_apprenant`, `id_session`),
    FOREIGN KEY (`id_apprenant`) REFERENCES apprenants (`id_apprenant`),
    FOREIGN KEY (`id_session`) REFERENCES sessions (`id_session`)
);

-- Create table for Formateurs
CREATE TABLE formateurs (
    `id_formateur` INT PRIMARY KEY,
    `nom_formateur` VARCHAR(50),
    `prenom_formateur` VARCHAR(50),
    `email_formateur` VARCHAR(50)
);

-- Create table for Formation
CREATE TABLE formation (
    `id_formation` INT PRIMARY KEY,
    `titre` VARCHAR(50),
    `description` TEXT,
    `id_formateur` INT,
    `mot_de_passe` VARCHAR(50),
   `image`VARCHAR(100),
    `categorie` VARCHAR(50),
    `masse_horaire` INT,
    CONSTRAINT titre_unique UNIQUE (`titre`),
    FOREIGN KEY (`id_formateur`) REFERENCES formateurs (`id_formateur`)
);