<?php
require_once 'database.php';
class not_islemleri extends Database
{
    public function not_ekle($ect)
    {   
        $not_ekle = $this->db->prepare("insert into notlar (not_icerik) values (?)");
        $not_ekle->execute([$ect]);
        $not_ekle = null;
        $_SESSION['not_id'] = $this->db->lastInsertId();
    }
    public function not_cek($not_id)
    {   
        $not_cek = $this->db->prepare("select * from notlar where not_id=?");
        $not_cek->execute([$not_id]);
        $sonuc = $not_cek->fetch(PDO::FETCH_ASSOC);
        $metin = $sonuc['not_icerik'];
        return $metin;
    }
}
?>