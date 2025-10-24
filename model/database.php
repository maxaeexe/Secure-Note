<?php
class Database {
    public $db;
    public $dbname = 'encrypt';

    public function __construct()
    {
        $host = 'localhost';
        $dbname = $this->dbname;
        $user = 'root';
        $pass = '';

        try {
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch (PDOException $e) {
            die("Veritabanı bağlantı hatası: " . $e->getMessage());
        }
    }
}
?>
