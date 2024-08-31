<?php
require_once '../functions.php';

if (isset($_POST['btn1'])) {
    submit($conn);
}

function submit($conn)
{
    if (isset($_POST['btn1'])) {
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $skema = $_POST['skema'];
        $estate = $_POST['kebun'];

        $submit = mysqli_query($conn, "INSERT INTO data_asisten(nik, nama, skema, estate) VALUES ('$nik', '$nama', '$skema', '$estate')");

        if ($submit) {
            echo "<script>alert('Data telah tersimpan')</script>";
        }
    }
}
