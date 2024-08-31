<?php
require_once "cek_sesi.php";
if($level === "Asesor"):
$asesor = $_POST['dariAsesor'];
$id_asesi = $_POST['asesi'];

$sql = "UPDATE uji_asesi SET asesor = '$asesor' WHERE id = $id_asesi";
if($conn->query($sql)){
    header("location:index.php?pesan=Ambil Asesi Berhasil");
}else{
    echo "gagal";
}
else :
header("location:login.php?pesan=anda belum login");
endif;