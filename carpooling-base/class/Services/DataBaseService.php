<?php

namespace App\Services;

use DateTime;
use Exception;
use PDO;

class DataBaseService
{
    const HOST = '127.0.0.1';
    const PORT = '3306';
    const DATABASE_NAME = 'carpooling';
    const MYSQL_USER = 'root';
    const MYSQL_PASSWORD = 'password';

    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DATABASE_NAME,
                self::MYSQL_USER,
                self::MYSQL_PASSWORD
            );
            $this->connection->exec("SET CHARACTER SET utf8");
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }

    /**
     * Create an user.
     */
    public function createUser(string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'INSERT INTO users (firstname, lastname, email, birthday) VALUES (:firstname, :lastname, :email, :birthday)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Return all users.
     */
    public function getUsers(): array
    {
        $users = [];

        $sql = 'SELECT * FROM users';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $users = $results;
        }

        return $users;
    }

    /**
     * Update an user.
     */
    public function updateUser(string $id, string $firstname, string $lastname, string $email, DateTime $birthday): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'birthday' => $birthday->format(DateTime::RFC3339),
        ];
        $sql = 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, birthday = :birthday WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Delete an user.
     */
    public function deleteUser(string $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM users WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    // ___________________________________________________________________________________________________________
    // ____________________________________________________Voiture________________________________________________
    /**
     * Créer une voiture.
     */
    public function createVoiture(String $model, string $couleur, int $vitesseMax): bool
    {
        $isOk = false;

        $data = [
            'model' => $model,
            'couleur' => $couleur,
            'vitesseMax' => $vitesseMax,
        ];
        $sql = 'INSERT INTO users (model, couleur, vitesseMax) VALUES (:model, :couleur, :vitesseMax)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * retourner toutes les voitures
     */
    public function getVoitures(): array
    {
        $voitures = [];

        $sql = 'SELECT * FROM voitures';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $voitures = $results;
        }

        return $voitures;
    }

    /**
     * mettre à jour une voiture.
     */
    public function updateVoiture(int $id, string $model, string $couleur, int $vitesseMax): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'model' => $model,
            'couleur' => $couleur,
            'vitesseMax' => $vitesseMax,
        ];
        $sql = 'UPDATE voitures SET model = :model, couleur = :couleur, vitesseMax = :vitesseMax WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Supprimer une voiture.
     */
    public function deleteVoiture(int $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM voitures WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    // ___________________________________________________________________________________________________________
    // _______________________________________________________Covoiturage_____________________________________________
    /**
     * Créer une annonce de covoiturage.
     */

    private $id;
    private $pointstart;
    private $pointend;
    private $date;
    private $available_place;
    private $price;

    public function createCovoiturage(String $pointstart, string $pointend, DateTime $date, int $available_place, int $price): bool
    {
        $isOk = false;

        $data = [
            'pointstart' => $pointstart,
            'pointend' => $pointend,
            'date' => $date,
            'available_place' => $available_place,
            'price' => $price,
        ];
        $sql = 'INSERT INTO covoiturages (pointstart, pointend, date, available_place, price) VALUES (:pointstart, :pointend, :date, :available_place , :price)';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * retourner toutes les annonces de covoiturages
     */
    public function getCovoiturages(): array
    {
        $covoiturages = [];

        $sql = 'SELECT * FROM covoiturages';
        $query = $this->connection->query($sql);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($results)) {
            $covoiturages = $results;
        }

        return $covoiturages;
    }

    /**
     * mettre à jour une annonce de covoiturage
     */
    public function updateCovoiturage(int $id, String $pointstart, string $pointend, DateTime $date, int $available_place, int $price): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
            'pointstart' => $pointstart,
            'pointend' => $pointend,
            'date' => $date,
            'available_place' => $available_place,
            'price' => $price,
        ];
        $sql = 'UPDATE covoiturages SET pointstart = :pointstart, pointend = :pointend, date = :date, available_place = :available_place, price = :price WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }

    /**
     * Supprimer une annonce de covoiturage
     */
    public function deleteCovoiturage(int $id): bool
    {
        $isOk = false;

        $data = [
            'id' => $id,
        ];
        $sql = 'DELETE FROM covoiturages WHERE id = :id;';
        $query = $this->connection->prepare($sql);
        $isOk = $query->execute($data);

        return $isOk;
    }


    // ___________________________________________________________________________________________________________
    // ___________________________________________________________________________________________________________
}
