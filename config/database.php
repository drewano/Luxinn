<?php
class Database {
    private $host = "localhost"; // ou l'adresse du serveur de base de données
    private $db_name = "LuxinDB"; // le nom de votre base de données
    private $username = "root"; // votre nom d'utilisateur pour la base de données
    private $password = "root"; // votre mot de passe pour la base de données
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Erreur de connexion à la base de données: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
