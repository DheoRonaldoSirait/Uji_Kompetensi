<?php
require_once('cek_sesi.php');
require_once('../functions.php');
if ($level === 'Asesor') :
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
        <link rel="stylesheet" href="../public/css/style.css" />
        <link rel="stylesheet" href="../public/css/w3.css">

        <!-- JS -->
        <script src="/js/script.js"></script>

        <!-- JQuery -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

        <!-- Font Awesome -->
        <link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />


        <title>Halaman - <?= $level; ?></title>
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="../public/logo.png">
    </head>

    <body class="w3-light-grey">

        <!-- Navbar -->
        <nav class="navbar navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    Asesor
                </a>
            </div>
        </nav>

        <div class="w3-content w3-white w3-padding w3-card w3-round" style="max-width: 800px; margin-top:45px; margin-bottom: 50px;">
            <div class="w3-margin">
                <h1 class="w3-text-blue-grey w3-center">Selamat Datang </h1>
                <a href="logout.php">
                    <div class="w3-button w3-red w3-right"><i class="fa fa-key"></i> Logout</div>
                </a>
                <div class="w3-button w3-orange w3-right" onclick="ubahPassword('<?= $nik; ?>')"><i class="fa fa-key"></i> Ubah Password</div>
                <p>Nama Asesor : <?= $nama; ?></p>
                <div class="w3-red" id="pesan"><?= $pesan = (isset($_GET['pesan'])) ? $_GET['pesan'] : ""; ?></div>
                <p>Berikut ini adalah nama-nama Asesi: <span class="w3-right w3-tag w3-green w3-hover-light-grey" style="cursor: pointer;" onclick="ambilAsesi()">

                        <form action="bap.php" method="post">
                            <table class="w3-table-all w3-hoverable">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Asesi</th>
                                    <th>Skema</th>
                                    <th colspan="5" align="center">Action</th>

                                    <th>Jadwal Observasi</th>
                                    <th>BAP</th>
                                </tr>
                                <?php
                                $sql = "SELECT * FROM uji_asesi a LEFT JOIN (SELECT id_asesi,clp,dpt,clo,dpw,vpk FROM uji_keputusan) b ON a.id = b.id_asesi WHERE a.asesor = '$nama' and a.status=2 ";
                                $hasil = $conn->query($sql);

                                if ($hasil->num_rows > 0) {
                                    $i = 1;
                                    while ($row = $hasil->fetch_assoc()) {
                                        $nama_asesi = $row['nama'];
                                        $fundamental = $row['fundamental'];
                                        $f = explode(";", $fundamental);
                                        $id = $row['id'];
                                        $tanggal = $row['tanggal'];

                                        $clp = iconAsesi('clp', $id, $row['clp'], $fundamental);
                                        $dpt = iconAsesi('dpt', $id, $row['dpt'], $fundamental);
                                        $clo = iconAsesi('clo', $id, $row['clo'], $fundamental);
                                        $dpw = iconAsesi('dpw', $id, $row['dpw'], $fundamental);
                                        $vpk = iconAsesi('vpk', $id, $row['vpk'], $fundamental);


                                        if (!in_array("Proses", $f)) {
                                            $vpk = "";
                                        }
                                        echo "<tr>
                                <td>$i</td>
                                <td>$nama_asesi</td>
                                <td>$fundamental</td>
                                <td align='center'>$clp   </td>
                                <td align='center'>$dpt</td>
                                <td align='center'>$clo</td>
                                <td align='center'>$dpw</td>
                                <td align='center'>$vpk</td>
                                <td>$tanggal </td>
                                <td><input type='checkbox' name='bap[]' class='w3-check' value=$id></td>
                                </tr>";

                                        $i++;
                                    }
                                }
                                ?>

                            </table>
                            <button class="w3-button w3-green" style="margin-top: 20px;">Buat BAP untuk Asesi</button>
                        </form>
            </div>
        </div>

        <div class="w3-modal w3-container" id="pindahAsesor">
            <div class="w3-container w3-content w3-light-grey w3-animate-zoom" style="max-width: 400px; margin-top: 55px;">
                <span class="w3-button w3-xxlarge w3-right" onclick="document.getElementById('pindahAsesor').style.display='none'">×</span>
                <h2 class="w3-center">Pindah Asesor</h2>
                <div class="w3-white w3-margin w3-padding">
                    <form action="pindah_asesor.php" method="post">
                        <input type="hidden" name="idAsesi" value="" id="idAsesi">
                        <p>
                            <select name="asesor" class="w3-input w3-border">
                                <option value="" selected disabled>Pilih Asesor...</option>
                                <?php
                                foreach ($nama_asesor as $n) {
                                    if ($n != $nama) {
                                        echo "<option value='$n'>$n</option>";
                                    }
                                }
                                ?>

                            </select>
                        </p>
                        <p>
                            <button class="w3-button w3-green">Submit</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <div class="w3-modal w3-container" id="ambilAsesi">
            <div class="w3-container w3-content w3-light-grey w3-animate-zoom" style="max-width: 400px; margin-top: 55px;">
                <span class="w3-button w3-xxlarge w3-right" onclick="document.getElementById('ambilAsesi').style.display='none'">×</span>
                <h2 class="w3-center">Ambil Asesi</h2>
                <div class="w3-white w3-margin w3-padding">
                    <form action="ambil_asesi.php" method="post">

                        <p>
                            <select name="asesor" class="w3-input w3-border" onchange="namaAsesi(this.value)">
                                <option value="" selected disabled>dari Asesor...</option>
                                <?php
                                foreach ($nama_asesor as $n) {
                                    if ($n != $nama) {
                                        echo "<option value='$n'>$n</option>";
                                    }
                                }
                                ?>
                            </select>
                            <select name="asesor" class="w3-input w3-border" id="asesor">
                                <option value='' selected disabled>pilih Asesi...</option>
                            </select>
                        </p>
                        <p>
                            <button class="w3-button w3-green">Submit</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <div class="w3-modal w3-container" id="ubahPassword">
            <div class="w3-container w3-content w3-light-grey w3-animate-zoom" style="max-width: 400px; margin-top: 55px;">
                <span class="w3-button w3-xxlarge w3-right" onclick="document.getElementById('ubahPassword').style.display='none'">×</span>
                <h2 class="w3-center">Ubah Password</h2>
                <div class="w3-white w3-margin w3-padding">
                    <form action="ubah_password.php" method="post">
                        <input type="hidden" name="nik_asesor" id="nikAsesor" value="<?= $nik; ?>">

                        <p>
                            <input type="text" name="passlama" id="passlama" placeholder="Password Lama.." class="w3-input w3-border" required>
                        </p>
                        <p>
                            <input type="text" name="passbaru" id="passbaru" placeholder="Password Baru.." class="w3-input w3-border" required>
                        </p>

                        <p>
                            <button class="w3-button w3-orange">Submit</button>
                        </p>
                    </form>
                </div>
            </div>
        </div>

    </body>
    <script>
        function ambilAsesi() {
            document.getElementById('ambilAsesi').style.display = "block";
        }

        function namaAsesi(str) {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                document.getElementById("asesor").innerHTML = this.responseText;
            }
            xmlhttp.open("GET", "nama_asesi.php?q=" + str);
            xmlhttp.send();

        }

        function ubahPassword(nik) {
            document.getElementById('nikAsesor').value = nik;
            document.getElementById('ubahPassword').style.display = "block";
        }
        <?php if (isset($_GET['pesan'])) : ?>
            setTimeout(hilangPesan, 5000);

            function hilangPesan() {
                document.getElementById("pesan").style.display = "none";
            }
        <?php endif; ?>
    </script>

    </html>
<?php

else :
    header("location:login.php?pesan=Anda belum login.");
endif;
?>