<?php
if(isset($_POST)){
    $nik = $_POST['id_asesor'];
    $id_asesi = $_POST['id_asesi'];
    $id_clp = $_POST['cek'];
    $keputusan = $_POST['keputusan'];
    $values = [];
    foreach($id_clp as $c => $d){
        $values[] = "(".$nik.",".$id_asesi.",".$c.")";
    }
    $val = implode(",",$values);
    include "../../functions.php";
    $sql = "INSERT INTO uji_valid_clp (id_asesor,id_asesi,id_clp) VALUES $val ";
    
    if($conn->query($sql)){
        $sql = "UPDATE uji_keputusan SET clp = '$keputusan'";
        $hasil = $conn->query($sql);
        var_dump($hasil);
        header("location:../index.php?pesan=CLP telah divalidasi!");
        exit;
    }else{
        echo "Gagal";
    }
}