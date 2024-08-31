<?php
$conn = new mysqli("localhost", "root", "", "db_pkl");
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
};

DEFINE('BASEURL', 'http://localhost/uji%20backup/');

function redirect($location)
{
    header('Location: ' . BASEURL . $location);
    exit();
}

function url_title($str, $separator = '-', $lowercase = FALSE)
{
    if ($separator === 'dash') {
        $separator = '-';
    } elseif ($separator === 'underscore') {
        $separator = '_';
    }

    $q_separator = preg_quote($separator, '#');

    $trans = array(
        '&.+?;'            => '',
        '[^\w\d _-]'        => '',
        '\s+'            => $separator,
        '(' . $q_separator . ')+'    => $separator
    );

    $str = strip_tags($str);
    foreach ($trans as $key => $val) {
        $str = preg_replace('#' . $key . '#i', $val, $str);
    }

    if ($lowercase === TRUE) {
        $str = strtolower($str);
    }
    return trim(trim($str, $separator));
}

function test_input($data)
{
    $data = trim($data);
    $data = addslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function status_uji($data)
{
    switch ($data) {
        case 1:
            echo "<p>Anda baru mengisi CLP, Ulangi Input Ceklis Portofolio dan Daftar Pertanyaan Tertulis Anda!</p>";
            break;
        case 2:
            echo "<p>Anda sudah mengikuti tahap awal Asesmen, silakan datang pada tanggal yang ditentukan untuk Observasi dan Wawancara!</p>";
            break;

        default:
            echo "<p>Ulangi Input Ceklis Portofolio dan Daftar Pertanyaan Tertulis Anda!</p>";
            break;
    }
}

function iconAsesi($jenis, $id, $nilai, $fundamental)
{
    switch ($jenis) {
        case 'clp':
            $warna = " w3-green w3-hover-light-grey";
            $ic = " fa-file-archive";
            break;
        case 'dpt':
            $warna = " w3-red w3-hover-light-grey";
            $ic = " fa-file-code";
            break;
        case 'clo':
            $warna = " w3-orange w3-hover-light-grey";
            $ic = " fa-binoculars";
            break;
        case 'dpw':
            $warna = " w3-blue w3-hover-light-grey";
            $ic = " fa-podcast";
            break;

        default:
            $warna = " w3-purple w3-hover-light-grey";
            $ic = " fa-file";
            break;
    }
    if (empty($nilai)) {
        $icon = "<a href='j/$jenis.php?id=$id&f=$fundamental'><span class='w3-tag w3-tooltip$warna' style='cursor: pointer;'><i class='fa$ic'></i><span class='w3-text'> " . strtoupper($jenis) . "</span> </span></a>";
    } else {
        $icon = "<a href='#'><span class='w3-tag w3-tooltip$warna' style='cursor: pointer;'><i class='fa$ic'> $nilai </i><span class='w3-text'> " . strtoupper($jenis) . "</span> </span></a>";
    }
    // $icon = "<a href='l/$jenis.php?id=$id&f=$fundamental'><span class='w3-tag w3-tooltip$warna' style='cursor: pointer;'><i class='fa$ic'> $nilai </i><span class='w3-text'> " . strtoupper($jenis) . "</span> </span></a>";
    return $icon;
}
