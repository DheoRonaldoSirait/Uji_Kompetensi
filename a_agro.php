<?php
include 'functions.php';

$nik = $_POST['nik'];

$sql = mysqli_query($conn, "SELECT estate FROM data_asisten WHERE nik = '$nik'");

while ($data = mysqli_fetch_array($sql)) {
    $estate = $data['estate'];
}

$sql = mysqli_query($conn, "SELECT nama FROM uji_asesor WHERE a_estate != '$estate' AND tugas = 'Agronomy'");
echo " <option value='' selected disabled>Pilih Asesor...</option>";
while ($asesor = mysqli_fetch_array($sql)) {
    $nama = $asesor['nama'];
    echo "<option value='$nama'>" . $nama . "</option>";
}
