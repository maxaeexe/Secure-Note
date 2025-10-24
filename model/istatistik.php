<?php
require_once 'database.php';
class istatistik extends Database
{
    public function toplam_kullanim()
    {   
        $sql = $this->db->prepare("select count(*) as toplam from notlar");
        $sql->execute();
        $cikti = $sql->fetch(PDO::FETCH_ASSOC);
        $toplam_kullanim = $cikti['toplam'];
        return $toplam_kullanim;
    }
}
?>