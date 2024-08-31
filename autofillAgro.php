<?php
include 'functions.php';

$nik = $_GET['nik'];
// $asesor = $_GET['asesor'];

// $data = mysqli_query($conn, "select a_estate from uji_asesor where nama='$asesor'");
// $estate = mysqli_fetch_array($data);

$sql = mysqli_query($conn, "select * from data_asisten where nik='$nik' and skema = 'Agronomy' ");
$asesi = mysqli_fetch_array($sql);

$data = array(
    'nama'  =>  $asesi['nama']
);

echo json_encode($data);
