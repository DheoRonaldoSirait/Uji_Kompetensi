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

        foreach ($f as $v) {

            $fund[] = "fundamental='" . $v . "'";
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



            <title>Uji Kompetensi</title>

            <!-- Favicon -->
            <link rel="icon" type="image/png" href="../../public/logo.png">

        </head>



        <body class="w3-light-grey">

            <div class="w3-content w3-white w3-padding w3-card w3-round" style="max-width: 800px; margin: 45px auto;">

                <div class="w3-margin">

                    <h2>CLP dari <?= $row['nama']; ?></h2>

                    <form action="valid_clp.php" method="post" id="frm1">

                        <input type="hidden" name="id_asesi" value="<?= $row['id']; ?>">

                        <input type="hidden" name="id_asesor" value="<?= $nik; ?>">

                        <input type="hidden" name="keputusan" id="lanjut" value="">

                        <table class="w3-table-all">

                            <tr>

                                <th>#</th>

                                <th>Item</th>

                                <th>Asesi</th>

                                <th>validasi</th>

                            </tr>

                            <?php

                            $sql = "SELECT c.id,c.item,u.id_clp,u.id_asesi FROM clp c LEFT JOIN ( SELECT id_asesi,id_clp FROM uji_jawab_clp WHERE id_asesi='$id' ) u ON c.id = u.id_clp WHERE $fundamental ORDER BY c.id ";

                            $hasil = $conn->query($sql);

                            $jml = $hasil->num_rows;

                            $i = 1;

                            while ($row = $hasil->fetch_assoc()) {

                                $item = $row['item'];

                                $id_clp = $row['id'];

                                $id_clp_asesi = $row['id_clp'];

                                $cek_asesi = "<input type='checkbox' class='w3-check' checked disabled />";

                                $cek_valid = "<input type='checkbox' class='w3-check' name='cek[$id_clp]' checked />";

                                if (empty($id_clp_asesi)) {

                                    $cek_asesi = "<input type='checkbox' class='w3-check' disabled />";

                                    $cek_valid = "<input type='checkbox' class='w3-check' name='cek[$id_clp]' />";
                                }



                                echo "<tr>

            <td>$i</td>

            <td>$item</td>

            <td>$cek_asesi</td>

            <td>$cek_valid</t>

        </tr>

        ";

                                $i++;
                            }



                            ?>

                        </table>



                        <p>

                            <input type="checkbox" name="sudah" id="cek" class="w3-check" onclick="onSudah('btn1', 'cek')" /> Sudah divalidasi

                        </p>

                        <button type="submit" id="btn1" class="w3-button w3-green" style="margin-top: 20px;" disabled>Submit</button>

                    </form>

                </div>

            </div>

            <script>
                function onSudah(btn, cek) {

                    var jmlCek = <?= $jml; ?>;

                    var x = document.forms["frm1"];

                    var hasil = 0;

                    var pass = jmlCek * 0.8;

                    var i;

                    var checkBox = document.getElementById(cek);

                    for (i = 3; i < jmlCek + 3; i++) {

                        if (x.elements[i].checked) {

                            hasil = hasil + 1;

                        }

                    }

                    if (hasil < pass) {



                        document.getElementById("lanjut").value = "BK";



                    } else {

                        document.getElementById("lanjut").value = "K";

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
