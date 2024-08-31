<?php

$level = "";

require "../../functions.php";

if (isset($_COOKIE['uji_k'])) {

    $cook = $_COOKIE['uji_k'];

    $data = explode("&", $cook);

    $nik = $data[0];

    $sesi = $data[1];

    $sql = "SELECT * FROM uji_asesor WHERE nik='$nik' and sha='$sesi' and is_active=1 LIMIT 1";

    $hasil = $conn->query($sql);

    if ($hasil->num_rows > 0) {

        $level = "Asesor";
    }
}

if ($level === "Asesor") :

    if (isset($_GET['id'])) :

        $id = $_GET['id'];

        $f = explode(";", $_GET['f']);

        $uji_soal = "uji_soal_f";

        foreach ($f as $v) {

            $fund[] = "fundamental='" . $v . "'";
        }

        if (in_array("Proses", $f)) {

            $uji_soal = "uji_soal_mill";
        }

        $fundamental = implode(" OR ", $fund);

        $sql = "SELECT id, nama FROM uji_asesi WHERE id=$id";

        $hasil = $conn->query($sql);

        $row = $hasil->fetch_assoc();

?>

        <!DOCTYPE html>

        <html lang="en">



        <head>

            <meta charset="UTF-8">

            <meta http-equiv="X-UA-Compatible" content="IE=edge">

            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">



            <title>Uji Kompetensi - DPT</title>

            <!-- Favicon -->
            <link rel="icon" type="image/png" href="../../public/logo.png">

        </head>



        <body class="w3-light-grey">

            <div class="w3-content w3-white w3-padding w3-card w3-round" style="max-width: 800px; margin: 45px auto;">

                <div class="w3-margin">

                    <h2>Daftar Pertanyaan Tertulis dari <?= $row['nama']; ?></h2>

                    <form action="valid_dpt.php" method="post" id="frm1">

                        <input type="hidden" name="id_asesi" value="<?= $row['id']; ?>">

                        <input type="hidden" name="id_asesor" value="<?= $nik; ?>">

                        <table class="w3-table-all">

                            <tr>

                                <th>#</th>

                                <th>soal</th>

                                <th>Score</th>

                            </tr>

                            <?php

                            $sql = "SELECT * FROM $uji_soal c LEFT JOIN ( SELECT id_asesi,id_soal,jawaban FROM uji_jawab_dpt WHERE id_asesi=$id ) u ON c.id = u.id_soal WHERE $fundamental ORDER BY c.id ";

                            $hasil = $conn->query($sql);

                            $jml_soal = $hasil->num_rows;

                            $nilai_per_soal = 0;

                            $total_score = 0;

                            $nilai_total = 0;

                            $i = 1;

                            $kategori = "Agro";

                            if (!in_array("Proses", $f)) :

                                while ($row = $hasil->fetch_assoc()) {

                                    $soal = $row['soal'];

                                    $id_soal = $row['id'];

                                    $id_soal_asesi = $row['id_soal'];

                                    $jawaban = $row['jawaban'];

                                    $nilai_per_soal = $row['nilai_max'];

                                    $nilai_total = $nilai_total + $nilai_per_soal;

                                    if (empty($id_soal_asesi)) {

                                        $jawaban = "";
                                    }

                                    $cek_valid = $row['kunci'];



                                    echo "<tr>

            <td>$i</td>

            <td>$soal <p>nilai max = $nilai_per_soal</p></td>

            <td><input type='number' name='score[$id_soal]' value=0 style='max-width: 50px;' min=0 max=$nilai_per_soal /></td>

        </tr>

        <tr>

            <td colspan=3>Jawaban Asesi : $jawaban</td>            

        </tr>

        <tr>

            <td colspan=3>Kunci Jawaban : $cek_valid</td>

        </tr>

        ";

                                    $i++;
                                }

                            else :

                                while ($row = $hasil->fetch_assoc()) {

                                    $soal = $row['soal'];

                                    $id_soal = $row['id'];

                                    $id_soal_asesi = $row['id_soal'];

                                    $j_a = $row['jawaban_a'];

                                    $j_b = $row['jawaban_b'];

                                    $j_c = $row['jawaban_c'];

                                    $j_d = $row['jawaban_d'];

                                    $nilai_per_soal = $row['nilai_max'];

                                    $jawaban = $row['jawaban'];

                                    if (empty($id_soal_asesi)) {

                                        $jawaban = "";
                                    }

                                    $cek_valid = $row['kunci'];

                                    if ($jawaban == $cek_valid) {

                                        $nilai = $nilai_per_soal;
                                    } else {

                                        $nilai = 0;
                                    }

                                    $cek_a = "";

                                    $cek_b = "";

                                    $cek_c = "";

                                    $cek_d = "";

                                    switch ($jawaban) {

                                        case 'A':

                                            $cek_a = " checked";

                                            break;

                                        case 'B':

                                            $cek_b = " checked";

                                            break;

                                        case 'C':

                                            $cek_c = " checked";

                                            break;



                                        default:

                                            $cek_d = " checked";

                                            break;
                                    }

                                    $total_score = $total_score + $nilai;

                                    echo "<tr>

                <td>$i</td>

                <td>$soal</td>

                <td><input style='max-width:60px;' type='number' name='score[$id_soal]' value=$nilai readonly /></td>

            </tr>

            <tr>

                <td colspan=3>Jawaban Asesi : 

                <ul class='w3-ul'>

                <li>

                    <input type='radio' class='w3-radio' $cek_a readonly />$j_a

                </li>

                <li>

                    <input type='radio' class='w3-radio' $cek_b readonly />$j_b

                </li>

                <li>

                    <input type='radio' class='w3-radio' $cek_c readonly />$j_c

                </li>

                <li>

                    <input type='radio' class='w3-radio' $cek_d readonly />$j_d

                </li>

                </ul>

                </td>            

            </tr>

            <tr>

                <td colspan=3>Kunci Jawaban : $cek_valid</td>

            </tr>

            ";

                                    $i++;
                                }

                                $kategori = "Mill";



                            endif;



                            ?>

                        </table>



                        <p>

                            <input type="checkbox" name="cek" id="cek" onchange="onHitung('btn1', 'cek')" class="w3-check"> Cek disini untuk perhitungan Total Score

                        </p>

                        <p>Total Score <input style='max-width:50px;' name='total_score' id="total_score" value='<?= $total_score; ?>' /><span id="lanjut"></span></p>

                        <input type="hidden" name="keputusan" value="" id="keputusan" />



                        <button type="submit" class="w3-button w3-green" style="margin-top: 20px;" id='btn1' disabled>Submit</button>

                    </form>

                </div>

            </div>

            <script>
                function onHitung(btn, cek) {

                    var jmlCek = <?= $nilai_total; ?>;

                    var pengulangan = <?= $jml_soal; ?>;

                    var x = document.forms["frm1"];

                    var hasil = 0;

                    var pass = jmlCek * 0.8;

                    var i;

                    var penambah = 0;

                    var kat = "<?= $kategori; ?>";

                    var checkBox = document.getElementById(cek);

                    if (kat == "Agro") {

                        for (i = 2; i < pengulangan + 2; i++) {

                            penambah = parseFloat(x.elements[i].value);

                            hasil = hasil + penambah;

                        }



                        document.getElementById("total_score").value = hasil;

                        if (hasil < pass) {

                            document.getElementById("keputusan").value = "BK";

                            document.getElementById("lanjut").innerHTML = "dari " + jmlCek + ", Belum Kompeten";

                            document.getElementById("keputusan").disabled = true;


                        } else {

                            document.getElementById("keputusan").value = "K";

                            document.getElementById("lanjut").innerHTML = "dari " + jmlCek + ", Kompeten";

                            document.getElementById("keputusan").disabled = true;

                        }

                    } else {

                        hasil = x.elements['total_score'].value;

                        if (hasil < 80) {

                            document.getElementById("keputusan").value = "BK";

                            document.getElementById("lanjut").innerHTML = "dari 100, Belum Kompeten";

                            document.getElementById("keputusan").disabled = true;

                        } else {

                            document.getElementById("keputusan").value = "K";

                            document.getElementById("lanjut").innerHTML = "dari 100, Kompeten";

                            document.getElementById("keputusan").disabled = true;

                        }

                    }

                    if (checkBox.checked == true) {
                        document.getElementById(btn).disabled = false;
                    } else {
                        document.getElementById(btn).disabled = true;
                    }



                }
            </script>

        </body>

        </html>

<?php

    else :

        header("location:../login.php?pesan=Anda belum login!");

    endif;

else :

    header("location:../login.php?pesan=Anda belum login!");

endif;
