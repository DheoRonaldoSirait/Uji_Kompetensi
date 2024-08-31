<?php
if (isset($_POST['proses'])) {
    submit($conn);
}

function submit($conn)
{
    if (isset($_POST['proses'])) {
        $active = 1;
        $pass = md5($_POST['pass']);
        $submit =  mysqli_query($conn, "UPDATE uji_asesor SET
        nik = '$_POST[nik]',
        nama = '$_POST[nama]',
        pass = '$pass',
        tugas = '$_POST[tugas]',
        is_active = '$active',
        a_estate = '$_POST[kebun]' WHERE id=$_GET[updateasesor]
        ") or die(mysqli_error($conn));

        // $nik = $_POST['nik'];
        // $nama = $_POST['nama'];
        // $pass = $_POST['pass'];
        // $tugas = $_POST['tugas'];
        // $estate = $_POST['kebun'];
        // $active = 1;
        // $sha = sha1($nik);

        // $submit = mysqli_query($conn, "INSERT INTO uji_asesor(nik, nama, pass, tugas, is_active, a_estate, sha) VALUES ('$nik', '$nama', MD5('$pass'), '$tugas', '$active','$estate', '$sha')");

        if ($submit) {
            echo "<script>alert('Data telah tersimpan')</script>";
        }
    }
}
