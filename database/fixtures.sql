USE covoiturage_entreprise;

-- =========================================================
-- AGENCES
-- =========================================================

INSERT INTO agence (ville) VALUES
('Paris'),
('Lyon'),
('Marseille'),
('Toulouse'),
('Nice'),
('Nantes'),
('Strasbourg'),
('Montpellier'),
('Bordeaux'),
('Lille'),
('Rennes'),
('Reims');


-- =========================================================
-- EMPLOYES
-- =========================================================

-- Compte administrateur :
-- alexandre.martin@email.fr
-- Mot de passe : Admin123!

-- Comptes utilisateurs :
-- Mot de passe commun : User123!

INSERT INTO employe (
    nom,
    prenom,
    telephone,
    email,
    mot_de_passe,
    role
) VALUES
(
    'Martin',
    'Alexandre',
    '0612345678',
    'alexandre.martin@email.fr',
    '$2y$12$75a2i/J67EgsQJdBoeIwIeca4wUfE/e7WiJ01T5VNnZNg/vpF.lUW',
    'ADMIN'
),
(
    'Dubois',
    'Sophie',
    '0698765432',
    'sophie.dubois@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Bernard',
    'Julien',
    '0622446688',
    'julien.bernard@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Moreau',
    'Camille',
    '0611223344',
    'camille.moreau@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Lefèvre',
    'Lucie',
    '0777889900',
    'lucie.lefevre@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Leroy',
    'Thomas',
    '0655443322',
    'thomas.leroy@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Roux',
    'Chloé',
    '0633221199',
    'chloe.roux@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Petit',
    'Maxime',
    '0766778899',
    'maxime.petit@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Garnier',
    'Laura',
    '0688776655',
    'laura.garnier@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Dupuis',
    'Antoine',
    '0744556677',
    'antoine.dupuis@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Lefebvre',
    'Emma',
    '0699887766',
    'emma.lefebvre@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Fontaine',
    'Louis',
    '0655667788',
    'louis.fontaine@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Chevalier',
    'Clara',
    '0788990011',
    'clara.chevalier@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Robin',
    'Nicolas',
    '0644332211',
    'nicolas.robin@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Gauthier',
    'Marine',
    '0677889922',
    'marine.gauthier@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Fournier',
    'Pierre',
    '0722334455',
    'pierre.fournier@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Girard',
    'Sarah',
    '0688665544',
    'sarah.girard@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Lambert',
    'Hugo',
    '0611223366',
    'hugo.lambert@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Masson',
    'Julie',
    '0733445566',
    'julie.masson@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
),
(
    'Henry',
    'Arthur',
    '0666554433',
    'arthur.henry@email.fr',
    '$2y$12$rN7TuO2IAFXDII5cNJvRce05q7TyIF4BHc0YM.csRL91KWJWxPS/u',
    'USER'
);


-- =========================================================
-- TRAJETS DE TEST
-- =========================================================

INSERT INTO trajet (
    date_heure_depart,
    date_heure_arrivee,
    nombre_places_total,
    nombre_places_disponibles,
    id_employe,
    id_agence_depart,
    id_agence_arrivee
) VALUES

-- Sophie : Paris -> Lyon
(
    '2026-09-10 08:00:00',
    '2026-09-10 12:30:00',
    4,
    3,
    2,
    1,
    2
),

-- Julien : Lyon -> Marseille
(
    '2026-09-11 09:00:00',
    '2026-09-11 12:30:00',
    5,
    2,
    3,
    2,
    3
),

-- Camille : Bordeaux -> Toulouse
(
    '2026-09-12 07:30:00',
    '2026-09-12 10:00:00',
    4,
    1,
    4,
    9,
    4
),

-- Lucie : Nantes -> Rennes
(
    '2026-09-13 14:00:00',
    '2026-09-13 15:30:00',
    3,
    2,
    5,
    6,
    11
),

-- Thomas : Strasbourg -> Reims
(
    '2026-09-14 08:15:00',
    '2026-09-14 11:00:00',
    4,
    4,
    6,
    7,
    12
),

-- Chloé : Nice -> Marseille
(
    '2026-09-15 10:00:00',
    '2026-09-15 12:30:00',
    3,
    0,
    7,
    5,
    3
),

-- Maxime : Montpellier -> Toulouse
(
    '2026-09-16 16:00:00',
    '2026-09-16 18:30:00',
    5,
    3,
    8,
    8,
    4
);