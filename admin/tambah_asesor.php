<?php
require_once '../functions.php';

if (isset($_POST['btn2'])) {
    submit($conn);
}

function submit($conn)
{
    if (isset($_POST['btn2'])) {
        $nik = $_POST['nik'];
        $nama = $_POST['nama'];
        $pass = md5($_POST['pass']);
        $tugas = $_POST['tugas'];
        $estate = $_POST['kebun'];
        $active = 1;
        $sha = sha1($nik);

        $submit = mysqli_query($conn, "INSERT INTO uji_asesor(nik, nama, pass, tugas, is_active, a_estate, sha) VALUES ('$nik', '$nama', '$pass', '$tugas', '$active','$estate', '$sha')");

        if ($submit) {
            echo "<script>alert('Data telah tersimpan')</script>";
        }
    }
}
