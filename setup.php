<?php
$host = "localhost";
$user = "root";
$pass = "";

try {
    $conn = new PDO("mysql:host=$host", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->exec("create database if not exists encrypt");
    $conn->exec("use encrypt");
    $conn->exec("
        create table if not exists notlar (
            not_id int auto_increment primary key,
            not_icerik text not null,
            not_tarih datetime default current_timestamp
        )
    ");

} catch (PDOException $e) {
    die("hata: " . $e->getMessage());
}
?>
