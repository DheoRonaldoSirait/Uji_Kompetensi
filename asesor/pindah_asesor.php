<?php
if (isset($_COOKIE['uji_k'])) {
    $id = $_POST['idAsesi'];
    $asesor = $_POST['asesor'];
    include("../functions.php");
    $sql = "UPDATE uji_asesi SET asesor = '$asesor' WHERE id=$id";
    $hasil = $conn->query($sql);
    if ($hasil) {
        header("location:index.php?pesan=Berhasil pindah Asesor");
        exit;
    } else {
        echo "error $hasil";
    }
    var_dump($_POST);
}
