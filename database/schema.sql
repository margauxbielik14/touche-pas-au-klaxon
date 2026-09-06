DROP DATABASE IF EXISTS covoiturage_entreprise;

CREATE DATABASE covoiturage_entreprise
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE covoiturage_entreprise;

CREATE TABLE employe (
    id_employe INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telephone VARCHAR(20) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'USER'
);

CREATE TABLE agence (
    id_agence INT AUTO_INCREMENT PRIMARY KEY,
    ville VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE trajet (
    id_trajet INT AUTO_INCREMENT PRIMARY KEY,
    date_heure_depart DATETIME NOT NULL,
    date_heure_arrivee DATETIME NOT NULL,
    nombre_places_total INT NOT NULL,
    nombre_places_disponibles INT NOT NULL,
    id_employe INT NOT NULL,
    id_agence_depart INT NOT NULL,
    id_agence_arrivee INT NOT NULL,

    CONSTRAINT fk_trajet_employe
        FOREIGN KEY (id_employe)
        REFERENCES employe(id_employe)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT fk_trajet_agence_depart
        FOREIGN KEY (id_agence_depart)
        REFERENCES agence(id_agence)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT fk_trajet_agence_arrivee
        FOREIGN KEY (id_agence_arrivee)
        REFERENCES agence(id_agence)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT chk_dates_coherentes
        CHECK (date_heure_arrivee > date_heure_depart),

    CONSTRAINT chk_places_total
        CHECK (nombre_places_total > 0),

    CONSTRAINT chk_places_disponibles
        CHECK (
            nombre_places_disponibles >= 0
            AND nombre_places_disponibles <= nombre_places_total
        )
);