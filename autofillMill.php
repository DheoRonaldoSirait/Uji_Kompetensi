<?php
include 'functions.php';

$nik = $_GET['nik'];
$sql = mysqli_query($conn, "select * from data_asisten where nik='$nik' and skema = 'Mill'");
$asesi = mysqli_fetch_array($sql);

$data = array(
    'nama'  =>  $asesi['nama']
);

echo json_encode($data);
