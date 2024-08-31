<?php

if (isset($_GET['id'])) :

    include "functions.php";

    $id = test_input($_GET['id']);

    $sql = "SELECT nik, nama, fundamental FROM uji_asesi WHERE id = $id";

    $hasil = $conn->query($sql);

    if ($hasil->num_rows > 0) {

        $row = $hasil->fetch_assoc();

        $f = explode(";", $row['fundamental']);

        $nik = $row['nik'];

        $nama = $row['nama'];
    }

    foreach ($f as $v) {

        $fund[] = "fundamental='" . $v . "'";
    }

    $fundamental = implode(" OR ", $fund);



    $sql = "SELECT id,item FROM clp WHERE $fundamental";



    $hasil = $conn->query($sql);

    $jml = $hasil->num_rows;

    $clp = [];

    while ($row = $hasil->fetch_assoc()) {

        $clp[] = $row;
    }

?>

    <!DOCTYPE html>

    <html lang="en">



    <head>

        <meta charset="UTF-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <!-- CSS -->
        <link rel="stylesheet" href="public/css/style.css" />
        <link rel="stylesheet" href="public/css/w3.css">

        <!-- JS -->
        <script src="/js/script.js"></script>

        <!-- JQuery -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

        <!-- Font Awesome -->
        <link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

        <title>Uji Kompetensi</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="public/logo.png">

    </head>



    <body class="w3-light-grey">

        <!-- Navbar -->
        <nav class="navbar navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    Asesi
                </a>
            </div>
        </nav>

        <div class="w3-content w3-white w3-padding w3-card w3-round" style="max-width: 800px; margin: 45px auto;">

            <h2>Cek kelengkapan dokumen portofolio anda</h2>

            <div class="w3-margin">

                <form action="proses_clp.php" method="post" id="frm1">



                    <input type="hidden" name="asesi_id" value="<?= $id; ?>">



                    <p>NIK: <?= $nik; ?>

                        <input type="hidden" name="nik" value="<?= $nik; ?>">

                    </p>

                    <p>Nama: <b><?= $nama; ?></b>

                        <input type="hidden" name="nama" value="<?= $nama; ?>">

                    </p>



                    <p class="w3-small w3-text-red">*isi ceklis jika dokumen ada dan tersedia</p>

                    <table class="w3-table-all">

                        <tr>

                            <th>#</th>

                            <th>Item</th>

                            <th style="width: 20%;">Bukti</th>

                        </tr>

                        <?php

                        $i = 1;

                        foreach ($clp as $c) {

                            $id = $c['id'];

                            $item = $c['item'];

                            echo "<tr>

                        <td>$i</td>

                        <td>$item</td>

                        <td>

                        <input type='checkbox' name='c[]' class='w3-check' value=$id id='check$i' ><label for='check$i'>ada</label>                        

                        </td>

                        </tr>";

                            $i++;
                        }

                        ?>

                    </table>

                    <p>

                        <input type="checkbox" name="sudah" id="sudah" onclick="onSudah()" class="w3-check"> Sudah saya periksa

                    </p>

                    <button type="submit" class="w3-button w3-green" style="margin-top: 20px;" id="lanjut" disabled>Submit</button>

                </form>

            </div>

        </div>

        <script>
            function onSudah() {

                var jmlCek = <?= $jml; ?>;

                var x = document.forms["frm1"];

                var hasil = 0;

                var pass = jmlCek * 0.8;

                var i;

                for (i = 4; i < jmlCek + 4; i++) {

                    if (x.elements[i].checked) {

                        hasil = hasil + 1;



                    }

                }

                if (hasil < pass) {

                    alert("Jumlah Ceklis Portofolio Anda kurang dari 80% dari standar, silakan lengkapi terlebih dahulu");

                    document.getElementById("lanjut").disabled = true;

                    document.getElementById("sudah").checked = false;

                } else {

                    document.getElementById("lanjut").disabled = false;

                }



            }
        </script>

    </body>



    </html>

<?php

else :

    header("location:index.php?pesan=Anda belum memilih skema");

endif;



?>