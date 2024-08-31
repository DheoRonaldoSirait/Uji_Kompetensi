<?php
if (isset($_COOKIE['uji_a'])) {
    $cook = $_COOKIE['uji_a'];
    include "../functions.php";
    $data = explode("&", $cook);
    $nik = $data[0];
    $sesi = $data[1];
    $sql = "SELECT * FROM tb_admin WHERE nik='$nik' and sha='$sesi' and is_active=1";
    $hasil = $conn->query($sql);
    if ($hasil->num_rows > 0) {
        $row = $hasil->fetch_assoc();
        $nik = $row['nik'];
        $nama = $row['nama'];
        $tugas = $row['tugas'];
        $level = 'Asesor';
        $sql = "SELECT nama FROM tb_admin WHERE tugas = '$tugas' and is_active=1";
        $hasil = $conn->query($sql);
        $nama_asesor = [];
        while ($row = $hasil->fetch_assoc()) {
            $nama_asesor[] = $row['nama'];
        }
    } else {
        setcookie("uji_a", "", time() - 86400, "/");
        header("location:login.php?pesan=Anda belum login");
        exit;
    }
} else {
    setcookie("uji_a", "", time() - 86400, "/");
    header("location:login.php?pesan=Anda belum login");
    exit;
}
