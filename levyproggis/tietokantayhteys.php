<?php
namespace foo;

use PDO;
// http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers#Connecting_to_MySQL

class tietokantayhteys {
    
    private $server,
            $username,
            $password,
            $database,
            $charset = 'UTF8' // utf8 / Latin1
            ; 
    
    private $db,
            $query,
            $results,
            $error;
    
    /**
     * Konstruktorifunktio
     * @param string $username Käyttäjänimi
     * @param string $password Salasana
     * @param string $server Serverin osoite
     * @param string $database Tietokanta johon otetaan yhteys
     */
    function __construct($username = "", $password = "", $server = "", $database = "") {
        $this->username = $username;
        $this->password = $password;
        $this->server = $server;
        $this->database = $database;
        
        $this->connect();
    }
    
    private function connect() {
        
        $params = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".$this->charset.";"
        ];
        
        try{
            $this->db = new \PDO('mysql:host='.$this->server.';dbname='.$this->database.';charset='.$this->charset, $this->username, $this->password, $params);
            //$this->db = new reconnecting_pdo('mysql:host='.$this->server.';dbname='.$this->database.';charset='.$this->charset, $this->username, $this->password, $params);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->exec("set names " . $this->charset . ";");
            $this->db->exec("SET CHARACTER SET utf8;");
            $this->db->exec("set session wait_timeout = 28800;");
            
        }
        catch(\PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
    
    function parseSql($sql) {
        $sql = trim($sql);
        $this->query = $this->db->prepare($sql);
        if ($this->query) {
            return true;
        }
        return false;
    }
    
    function doBindSql($b = array()) {
        
        $b = $this->utf8_dekode($b);
        
         try {
            $this->checkIfConnectionAlive();
            if ($this->query->execute($b)) {
                $this->results = $this->query;
                $this->error="";
                return true;
            }
            else {
                $this->error=$this->db->errorInfo();
                var_dump($this->error);
                return false;
            }
        } catch(PDOException $ex) {
            $this->error = $ex->getMessage();
            unset($this->results);
            return false;
        }
        
    }

    private function checkIfConnectionAlive() {
        try {
            $this->db->query("SHOW STATUS;")->execute();
        } catch(\PDOException $e) {
            if($e->getCode() != 'HY000' || !stristr($e->getMessage(), 'server has gone away')) {
                throw $e;
            }

            $this->db = null;
            $this->connect();
        }
    }
    
    function doSql($sql) {
        $sql = trim($sql);
        try {
            $this->checkIfConnectionAlive();
            //connect as appropriate as above
            $this->results = $this->db->query($sql);
            $this->error="";
            return true;
        } catch(\PDOException $ex) {
            $this->error = $ex->getMessage();
            unset($this->results);
            return false;
        }
    }
    
    function getError() {
        return $this->error;
    }
    
    
    function getResults() {
        try {
            return $this->results->fetchAll(PDO::FETCH_BOTH);
        }
        catch (\PDOException $ex) {
            $this->error = $ex->getMessage();
            return false;
        }
    }

    function getResultsAssoc() {
        try {
            return $this->results->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (\PDOException $ex) {
            $this->error = $ex->getMessage();
            return false;
        }

    }

    /**
     * Palauttaa kuinka montaa riviä edellinen delete/insert/update kosketti
     * @return mixed
     */
    function getAffectedRows() {
        return $this->query->rowCount();
    }

    /**
     * Palauttaa edellisen insert-lauseen jälkeen tulevan auto increment id:n
     * @return mixed
     */
    function getLastInsertId() {
        return $this->db->lastInsertId();
    }
    
    private function utf8_dekode($s) {
        return $s;
        /* muunsin kannan utf8 muotoon joten tätä ei tarvita
        if (is_array($s)) { // jos tuli array niin käydään se läpi 
            foreach ($s as $a => $b) {
                $d[$a] = trim($this->utf8_dekode($b));
            }
            $s = $d;
        }
        else {
            if (preg_match('!!u', $s)) { // tsekataan onko stringi utf8 vai ei
               $s = trim(utf8_decode($s));
            }
        }
        return $s;*/
    }
    
}

