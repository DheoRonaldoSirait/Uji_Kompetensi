<?php

include "../functions.php";
if (!isset($_COOKIE['uji_a'])) {
    $nik = test_input($_POST['nik']);
    $pass = md5($_POST['pass']);
    $sql = "SELECT * FROM tb_admin WHERE nik='$nik' and pass='$pass' and is_active=1";
    $hasil = $conn->query($sql);
    if ($hasil->num_rows > 0) {
        $cookie_name = "uji_a";
        $session = sha1($nik);
        $cookie_value = $nik . "&" . $session;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 365), "/");

        header("location:index.php");
    } else {
        setcookie("uji_a", "", time() - 86400, "/");
        header("location:login.php?pesan=Username atau Password anda salah");
    }
} else {
    $cook = $_COOKIE['uji_a'];

    $data = explode("&", $cook);
    $nik = $data[0];
    $sesi = $data[1];
    $sql = "SELECT * FROM tb_admin WHERE nik='$nik' and sha='$sesi' and is_active=1";
    $hasil = $conn->query($sql);
    if ($hasil->num_rows > 0) {

        header("location:index.php");
    } else {
        setcookie("uji_a", "", time() - 86400, "/");
        header("location:login.php?pesan=Anda belum login");
    }
}
