<?php
if(isset($_POST)){
    $id_asesi = $_POST['id_asesi'];
    $id_asesor = $_POST['id_asesor'];
    $nilai = $_POST['total_score'];
    $keputusan = "K";
    if($nilai<80){
        $keputusan="BK";
    }
    include "../../functions.php";
    $sql = "INSERT INTO uji_valid_dpt (id_asesi, id_asesor, nilai) VALUES ($id_asesi,$id_asesor,$nilai)";
    if($conn->query($sql)){
        $sql ="UPDATE uji_keputusan SET dpt='$keputusan' WHERE id_asesi=$id_asesi";
        $hasil = $conn->query($sql);
        header("location:../index.php?pesan=DPT telah divalidasi");
    }else{
        die;
    }
}