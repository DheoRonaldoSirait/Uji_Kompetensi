<?php

$sql = "SELECT * FROM uji_asesi WHERE acak='$slug'";
$hasil = $conn->query($sql);
$ttd = [];
if ($hasil->num_rows > 0) {
    $row = $hasil->fetch_assoc();
    $row['Sebagai'] = 'Asesi';
    $ttd[] = $row;
} else {
    $sql = "SELECT * FROM uji_asesor WHERE sha='$slug'";
    $hasil = $conn->query($sql);
    if ($hasil->num_rows > 0) {
        $row = $hasil->fetch_assoc();
        $row['Sebagai'] = 'Asesor';
        $ttd[] = $row;
    } else {
        $row['nama'] = "Nama tidak ditemukan";
        $row['Sebagai'] = "";
        $ttd[] = $row;
    }
}
?>
<div class="w3-content w3-white w3-padding w3-card w3-round" style="max-width: 800px; margin-top:45px; margin-bottom: 50px;">
    <div class="w3-margin">
        <h1 class="w3-text-blue-grey">Informasi QR Code:</h1>
        <p>Dokumen ini ditandatangani secara elektronik oleh:</p>
        <?php
        foreach ($ttd as $t) {
            $nama = $t['nama'];
            $sbg = $t['Sebagai'];
            echo "<h3 class='w3-text-green'><b>$nama</b></h3>";
            if ($sbg != "") {
                echo "<p>Sebagai : <b>$sbg</b> untuk keperluan Asesmen Kompetensi</p>";
            }
        } ?>

    </div>
</div>