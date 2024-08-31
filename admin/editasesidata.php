<?php
if (isset($_POST['proses'])) {
    submit($conn);
}

function submit($conn)
{
    if (isset($_POST['proses'])) {
        $submit =  mysqli_query($conn, "UPDATE data_asisten SET
        nik = '$_POST[nik]',
        nama = '$_POST[nama]',
        estate = '$_POST[kebun]',
        skema = '$_POST[skema]' WHERE id=$_GET[update] 
        ") or die(mysqli_error($conn));


        if ($submit) {
            echo "<script>alert('Data telah tersimpan')</script>";
        }
    }
}

// if ($_POST['btn1']) {
//     mysqli_query($conn, "UPDATE data_asisten SET
//         nik = '$_POST[nik]'
//         nama = '$_POST[nama]'
//         skema = '$_POST[kebun]'
//         estate = '$_POST[skema]'
//         ");

//     echo "<script>alert('Data telah tersimpan')</script>";
// }
