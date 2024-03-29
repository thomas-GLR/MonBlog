<?php

namespace App;

use \PDO;

class Database {

    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;

    public function __construct($db_name, $db_user, $db_pass, $db_host) {
        
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;

    }

    public function getPDO() {

        // Permet de se connecter qu'une seul fois à la base de données
        if ($this->pdo === null) {

            $pdo = new PDO("mysql:dbname=$this->db_name;host=$this->db_host", $this->db_user, $this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;

        }

        return $this->pdo;

    }

    public function query($statement, $class_name) {
        $requete = $this->getPDO()->query($statement);
        $data = $requete->fetchAll(PDO::FETCH_CLASS, $class_name);
        return $data;
    }

    public function queryObject($statement) {
        $requete = $this->getPDO()->query($statement);
        $data = $requete->fetch(PDO::FETCH_OBJ);
        return $data;
    }
    /*
    public function preparedQuery($statement) {
        $query = $this->getPDO()->prepare($statement);
        $result = $query->execute($this->email, $this->mdp);
        var_dump($result);
    }*/

}