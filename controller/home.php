<?php

class home{
    function index()
    {
        require_once('model/istatistik.php');
        $model = new istatistik();
        $toplam_kullanim = $model->toplam_kullanim();
        view::show("index",[
            'title'=> 'SecureNote - Güvenli Not Paylaşımı',
            'toplam'=> $toplam_kullanim
        ]);
    }
    function not_ekle()
    {
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $token=$_POST['token'];
            csrf::token_kontrol($token);

            $metin = $_POST['metin'];
            $pass = $_POST['pass'];
            if(!isset($pass) || !isset($metin) || $pass == "" || $metin == ""){
                $_SESSION['alert']="Lütfen Boş Yer Bırakmayınız!";
                header("Location: /index");
                exit();
            }
            $sifrelenmis_metin = encrypt($metin,$pass);
            require_once('model/not_islemleri.php');
            $model = new not_islemleri();
            $model->not_ekle($sifrelenmis_metin);
            header("Location: /index");
        }else{
            header("Location: /index");
        }
    }
    function not_goruntule()
    {
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $token=$_POST['token'];
            csrf::token_kontrol($token);

            $not_id = $_POST['not_id'];
            $pass = $_POST['pass'];
            if(!isset($pass) || !isset($not_id) || $pass == "" || $not_id == ""){
                $_SESSION['alert']="Lütfen Boş Yer Bırakmayınız!";
                header("Location: /index");
                exit();
            }
            
            require_once('model/not_islemleri.php');
            $model = new not_islemleri();
            $metin = $model->not_cek($not_id);

            $_SESSION['acilmis_metin'] = decrypt($metin,$pass);
            header("Location: /index");
        }else{
            header("Location: /index");
        }
    }
}
?>