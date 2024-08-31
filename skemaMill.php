<?php

if (!empty($_POST)) :

    include "functions.php";

    $fundamental = $_POST['f'];

    $f = [];

    foreach ($fundamental as $key => $v) {

        if (!empty($v)) {

            $f[] = $v;
        }
    }

    $f = implode(";", $f);



    $nik = test_input($_POST['nik']);

    $nama = strtoupper(test_input($_POST['namaMill']));

    $asesor = test_input($_POST['asesor']);

    $tanggal = test_input(date('d-m-Y', strtotime($_POST['tanggal'])));

    $acak = md5($nik . $tanggal);

    $sql = "INSERT INTO uji_asesi (nik, nama, asesor, tanggal, fundamental,  acak) VALUES ('$nik', '$nama', '$asesor', '$tanggal', '$f',  '$acak')";

    echo $sql;

    if ($conn->query($sql) === TRUE) {

        $last_id = $conn->insert_id;

        header("location:isi_clp.php?id=$last_id");
    } else {

        echo "Error: " . $sql . "<br>" . $conn->error;
    }



else :

    header("location: index.php?pesan=Anda Belum Memilih skema");

endif;


// if (!empty($_POST)) :

//     include "functions.php";

//     $fundamental = $_POST['f'];

//     $f = [];

//     foreach ($fundamental as $key => $v) {

//         if (!empty($v)) {

//             $f[] = $v;
//         }
//     }

//     $f = implode(";", $f);



//     $nik = test_input($_POST['nik']);

//     $nama = strtoupper(test_input($_POST['namaMill']));

//     $asesor = test_input($_POST['asesor']);

//     $tanggal = test_input(date('d-m-Y', strtotime($_POST['tanggal'])));

//     $acak = md5($nik . $tanggal);

//     $sql = "INSERT INTO uji_asesi (nik, nama, asesor, tanggal, fundamental,  acak) VALUES ('$nik', 'test', '$asesor', '$tanggal', '$f',  '$acak')";

//     echo $sql;

//     if ($conn->query($sql) === TRUE) {

//         $last_id = $conn->insert_id;

//         header("location:isi_clp.php?id=$last_id");
//     } else {

//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }



// else :

//     header("location: index.php?pesan=Anda Belum Memilih skema");

// endif;
