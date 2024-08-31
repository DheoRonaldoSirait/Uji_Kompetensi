<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <link rel="stylesheet" href="../styles/w3.css">

    <title>Uji Kompetensi</title>
</head>

<body class="w3-light-grey">
<div class="w3-content w3-white w3-padding w3-card w3-round" style="max-width: 800px; margin: 45px auto;">
    <div class="w3-margin">
<?php
include "functions.php";
$nik = test_input($_POST['nik']);
$tanggal = test_input($_POST['tanggal']);
$acak = md5($nik.$tanggal);
$sql = "SELECT * FROM uji_asesi WHERE acak = '$acak' ORDER BY id DESC LIMIT 1";
$hasil = $conn->query($sql);
if ($hasil->num_rows > 0) {
   $row = $hasil->fetch_assoc(); 
    status_uji($row['status']);        
} else {
    echo "<p>ini salah Ulangi Input Ceklis Portofolio dan Daftar Pertanyaan Tertulis Anda!</p>";
}
echo "<a href='index.php'><div class='w3-button w3-green'>back</div></a>";
?>
    </div>
</div>
</body>
</html>