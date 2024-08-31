<?php

$nik = $_POST['nik'];
$nama = $_POST['nama'];
$id = $_POST['asesi_id'];

include "functions.php";

$sql = "SELECT nik, nama, fundamental FROM uji_asesi WHERE id = $id";
$hasil = $conn->query($sql);
if($hasil->num_rows > 0){
    $row = $hasil->fetch_assoc();
    $f = explode(";", $row['fundamental']);
    $nik = $row['nik'];
    $nama = $row['nama'];
}

$values = [];
foreach($_POST['c'] as $c){
    $values[] = "(".$id.",". $c.")";
}

$v = implode(",",$values);
$sql = "INSERT INTO uji_jawab_clp (id_asesi, id_clp) VALUES $v";
if ($conn->query($sql) === FALSE) {
    echo "Error: " . $sql . "<br>" . $conn->error;   
  }
  $sql = "UPDATE uji_asesi SET status=1 WHERE id=$id";
  if($conn->query($sql)){
      header("location:isi_dpt.php?id=$id");
  };
?>