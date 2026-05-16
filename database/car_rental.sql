
CREATE DATABASE car_rental;

USE car_rental;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    role ENUM('client','agence','admin'),
    permis_photo VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    agence_id INT,
    marque VARCHAR(100),
    modele VARCHAR(100),
    prix_jour DECIMAL(10,2),
    image VARCHAR(255),
    disponible BOOLEAN DEFAULT 1,
    FOREIGN KEY (agence_id) REFERENCES users(id)
);

CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    car_id INT,
    date_debut DATE,
    date_fin DATE,
    statut ENUM('en_attente','acceptee','refusee','annulee') DEFAULT 'en_attente',
    paiement ENUM('non_paye','paye') DEFAULT 'non_paye',
    FOREIGN KEY (client_id) REFERENCES users(id),
    FOREIGN KEY (car_id) REFERENCES cars(id)
);