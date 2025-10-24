<?php
class csrf
{
    public static function token_olustur()
    {
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function token_kontrol($token)
    { 
        if($_SESSION['csrf_token'] != $token){
            $_SESSION['alert']="Token Hatası!!";
            header("Location: /index");
            exit();
        }
    }
}
?>