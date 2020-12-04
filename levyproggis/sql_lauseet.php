<?php
require_once 'tietokantayhteys.php';
class sql_lauseet {
    
    private $db;
   // private $results;
    private $virhe;
    
    /**
     * Konstruktori
     * @param string $test testimuuttuja
     */
    public function __construct() {
        
        global $config;
        
    $mysli = new foo\tietokantayhteys($config['db']['mysql']['username'], $config['db']['mysql']['password'], $config['db']['mysql']['host'], $config['db']['mysql']['dbname']);
        
        
        $this->db = $mysli;
        
    }
        public function haeTekija(){
            $sql = "SELECT * FROM tekija";
            return $this->_ajaArray($sql);
  
        }
        public function tulostaNimikkeet(){
            $sql = "SELECT t.nimi, n.nimike_nimi, n.tyyppi FROM tekija t, nimike n WHERE n.esittaja_id = t.id ORDER BY t.nimi, n.nimike_nimi ASC";
            return $this->_ajaArray($sql);
        }

                public function tallennaKantaanEsittaja($esittaja){
            $sql = "INSERT INTO tekija (nimi) VALUES (:esittaja)";
            $this->db->parseSql($sql);
            $res = $this->db->doBindSql
                    ([':esittaja'=>$esittaja]);
            return $this->db->getLastInsertId();
            
        }
        
        public function tallennaKantaanNimike($esittaja_id,$tyyppi, $nimike){
            $sql = "INSERT INTO nimike (nimike_nimi, tyyppi, esittaja_id) VALUES (:nimike_nimi,:tyyppi,:esittaja_id)";
            $this->db->parseSql($sql);
            $res = $this->db->doBindSql
            ([':nimike_nimi'=>$nimike,
                ':tyyppi'=>$tyyppi,
            ':esittaja_id'=>$esittaja_id]);
            return $this->_ajaPelkkaSql($sql);
            
        }
            
    private function _ajaPelkkaSql($sql) {
        if (!$this->db->doSql($sql)) {
            $this->virhe = $this->db->getError();
            return false;
        }
        return true;
    }
    
      private function _ajaArray($sql) {
        if (!$this->db->doSql($sql)) {
            $this->virhe = $this->db->getError();
            return false;
        }
        return $this->db->getResultsAssoc();
    }
       public function naytaTulokset() {
        return $this->db->getResults();
    }
}