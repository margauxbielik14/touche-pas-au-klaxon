USE covoiturage_entreprise_test;

CREATE TABLE IF NOT EXISTS employe (
    id_employe INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    telephone VARCHAR(20) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'USER'
);

CREATE TABLE IF NOT EXISTS agence (
    id_agence INT AUTO_INCREMENT PRIMARY KEY,
    ville VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS trajet (
    id_trajet INT AUTO_INCREMENT PRIMARY KEY,
    date_heure_depart DATETIME NOT NULL,
    date_heure_arrivee DATETIME NOT NULL,
    nombre_places_total INT NOT NULL,
    nombre_places_disponibles INT NOT NULL,
    id_employe INT NOT NULL,
    id_agence_depart INT NOT NULL,
    id_agence_arrivee INT NOT NULL,

    CONSTRAINT fk_test_trajet_employe
        FOREIGN KEY (id_employe)
        REFERENCES employe(id_employe)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT fk_test_trajet_agence_depart
        FOREIGN KEY (id_agence_depart)
        REFERENCES agence(id_agence)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT fk_test_trajet_agence_arrivee
        FOREIGN KEY (id_agence_arrivee)
        REFERENCES agence(id_agence)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT chk_test_dates
        CHECK (date_heure_arrivee > date_heure_depart),

    CONSTRAINT chk_test_places_total
        CHECK (nombre_places_total > 0),

    CONSTRAINT chk_test_places_disponibles
        CHECK (
            nombre_places_disponibles >= 0
            AND nombre_places_disponibles <= nombre_places_total
        )
);