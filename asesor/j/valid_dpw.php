<?php
if(isset($_POST)){
    $id_asesi = $_POST['id_asesi'];
    $id_asesor = $_POST['id_asesor'];
    $score = $_POST['score'];
    $v = [];
    foreach($score as $s=>$k){
        $v[] = "(".$id_asesi.",".$id_asesor.",".$s.")";
    }
    $values = implode(",",$v);
    $total_score = $_POST['total_score'];
    $keputusan = $_POST['keputusan'];
    include "../../functions.php";
    $sql = "INSERT INTO uji_valid_dpw (id_asesi,id_asesor,id_dpw) VALUES $values";
    $hasil = $conn->query($sql);
    if($hasil){
        $sql = "UPDATE uji_keputusan SET dpw='$keputusan' WHERE id_asesi=$id_asesi";
        $hasil = $conn->query($sql);
        header("location:../index.php?pesan=DPW sudah divalidasi");
    }else{
        var_dump($sql);
    }
}