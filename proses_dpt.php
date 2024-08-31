<?php
include "functions.php";
$id_asesi = $_POST['id_asesi'];
$jawaban = $_POST['j'];
$values = [];
foreach($jawaban as $j => $v){
    if(!empty($v)){
    $values[] = "(".$id_asesi.",".$j.",'".$v."')";    
    }
}
$v = implode(",",$values);
$sql = "INSERT INTO uji_jawab_dpt (id_asesi, id_soal, jawaban) VALUES $v";
if ($conn->query($sql) === TRUE){
    $sql = "UPDATE uji_asesi set status=2 where id=$id_asesi";
    $conn->query($sql);
    $sql = "INSERT INTO uji_keputusan (id_asesi) VALUES ($id_asesi)";
    $conn->query($sql);
    header("location:index.php?selesai=1");
    exit;
}else {
    echo "Error: " . $sql . "<br>" . $conn->error;   
  }
?>
