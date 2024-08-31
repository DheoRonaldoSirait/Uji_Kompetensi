<?php

require_once "cek_sesi.php";

if ($level === "Asesor") :

    $nik = $_POST['nik_asesor'];

    $passlama = md5($_POST['passlama']);

    $passbaru = md5($_POST['passbaru']);

    $sql = "SELECT * FROM uji_asesor WHERE pass='$passlama'";

    $data_pass = mysqli_query($conn, "select * from uji_asesor WHERE nik='$nik'");

    while ($data = mysqli_fetch_assoc($data_pass)) {
        $pass = $data['pass'];
    }

    $sql = "SELECT * FROM uji_asesor WHERE pass='$passlama'";

    $hasil = $conn->query($sql);

    if ($pass == $passlama) {

        if ($hasil->num_rows > 0) {

            $sql = "UPDATE uji_asesor SET pass='$passbaru' WHERE nik='$nik'";

            if ($conn->query($sql)) {

                header("location:index.php?pesan=Berhasil Ubah Password!");
            } else {

                header("location:index.php?pesan=Gagal Ubah Password!");
            }
        }
    } else {
        header("location:index.php?pesan=Password lama salah!");
    }



// if ($hasil->num_rows > 0) {

//     $sql = "UPDATE uji_asesor SET pass='$passbaru' WHERE nik='$nik'";

//     if ($conn->query($sql)) {

//         header("location:index.php?pesan=Berhasil Ubah Password!");
//     } else {

//         header("location:index.php?pesan=Gagal Ubah Password!");
//     }
// } else

//     header("location:login.php?pesan=Anda belum login!");

endif;
