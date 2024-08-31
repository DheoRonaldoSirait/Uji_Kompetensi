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
    <script src="public/js/jquery.js"></script>

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
    <?php
    include('functions.php');
    if (!isset($_GET['c']) && !isset($_GET['selesai'])) :
        $sql = "SELECT nama, tugas, a_estate FROM uji_asesor WHERE is_active=1";
        $hasil = $conn->query($sql);
        $asesor = [];

        while ($row = $hasil->fetch_assoc()) {
            $asesor[] = $row;
        }
        $sql = "SELECT judul_uk, fundamental FROM uji_uk";
        $hasil = $conn->query($sql);
        $uk = [];
        while ($row = $hasil->fetch_assoc()) {
            $uk[] = $row;
        }

    ?>
        <!-- Navbar -->
        <nav class="navbar navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    Asesi
                </a>
            </div>
        </nav>

        <div class="container shadow-lg rounded-3 animated animatedFadeInUp fadeInUp w3-content w3-white w3-padding w3-card w3-round" style="max-width: 800px; margin: 45px auto;">
            <div class="w3-margin">
                <h1 class="w3-center">Selamat Datang</h1>
                <div class="d-flex justify-content-center">
                    <p>Untuk melakukan Uji/Asesmen Kompetensi, silakan pilih skema yang sesuai
                </div>
                <div class="">
                    <div class="w3-button w3-green" onclick="openSkema('agro')">Agronomy</div>
                    <div class="w3-button w3-blue" onclick="openSkema('mill')">Mill</div>
                </div>


                <!-- Agronomy -->
                <div class="w3-border skema w3-padding animated animatedFadeInUp fadeInUp" id="agro" style="display: none;">
                    <h4>Skema Untuk <span class="w3-text-green">Agronomy</span></h4>
                    <form action="skemaAgro.php" method="post" id="formAgro">
                        <p>
                            <input type="checkbox" name="f[1]" id="f[1]" class="w3-check" value="F1"> <label for="f1">Fundamental 1</label>
                        </p>
                        <p>
                            <input type="checkbox" name="f[2]" id="f[2]" class="w3-check" value="F2"> <label for="f2">Fundamental 2</label>
                        </p>
                        <p>
                            <input type="checkbox" name="f[3]" id="f[3]" class="w3-check" value="F3"> <label for="f3">Fundamental 3</label>
                        </p>
                        <p>
                            <input type="text" name="nik" id="nikAgro" placeholder="NIK Anda..." class="w3-border w3-input w3-round" onkeyup="autofillAgro('Agro')" required>
                        </p>
                        <p>
                            <input type="text" name="namaAgro" id="namaAgro" placeholder="Nama Anda..." class="w3-border w3-input w3-round" readonly required>
                        </p>
                        <p>
                            <input type="date" name="tanggal" id="tanggal" placeholder="Tanggal Uji..." class="w3-border w3-input w3-round" min=<?php echo date('Y-m-d'); ?> required>
                        </p>
                        <p>
                            <select name="asesor" id="asesorAgro" class="w3-border w3-select" required>
                                <option value="" selected disabled>Pilih Asesor...</option>
                                <!-- <?php
                                        foreach ($asesor as $a) {
                                            if ($a['tugas'] == "Agronomy") {
                                                $nama = $a['nama'];
                                                echo "<option value='$nama' id='asesorAgro'>$nama</option>";
                                            }
                                        }
                                        ?> -->
                            </select>
                        </p>
                        <p>Klik <span class="w3-text-blue" onclick="onLihat('ukAgro')" style="cursor: pointer;">disini untuk melihat Unit Kompetensi yang diujikan</span></p>
                        <p>
                            <input type="checkbox" name="setuju" class="w3-check" value=1 onclick="onSetuju('btn1', 'cek1')" id="cek1"> <label for="setuju"> Saya setuju untuk mengikuti Uji Kompetensi ini</label>
                        </p>
                        <button type="submit" class="w3-button w3-round w3-green" id="btn1" disabled>Submit</button>
                    </form>
                </div>

                <!-- Mill -->
                <div class="w3-border skema w3-padding animated animatedFadeInUp fadeInUp" id="mill" style="display: none;">
                    <h4>Skema Untuk <span class="w3-text-blue">Mill</span></h4>
                    <form action="skemaMill.php" method="post">
                        <p>
                            <!-- onkeyup="autofillMill('Mill')" -->
                            <input type="text" name="nik" id="nikMill" placeholder="NIK Anda..." class="w3-border w3-input w3-round" onkeyup="autofillMill('Mill')" required>
                        </p>
                        <p>
                            <input type="text" name="namaMill" id="namaMill" placeholder="Nama Anda..." class="w3-border w3-input w3-round" readonly required>
                        </p>
                        <p>
                            <input type="date" name="tanggal" id="tanggal" placeholder="Tanggal Uji..." min=<?php echo date('Y-m-d'); ?> class="w3-border w3-input w3-round" required>
                        </p>
                        <p>
                            <select name="asesor" id="asesorMill" class="w3-border w3-select" required>
                                <option value='' selected disabled>Pilih Asesor...</option>
                                <!-- 
                                <?php
                                foreach ($asesor as $a) {
                                    if ($a['tugas'] == "Mill") {
                                        $nama = $a['nama'];
                                        echo "<option value='$nama' id='asesorMill' '>$nama</option>";
                                    }
                                }
                                ?> -->

                            </select>
                        </p>

                        <p>Apakah Anda pernah menjadi Asisten Proses?</p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="f[4]" id="proses" value="Proses" onclick="onProses()">
                            <label class="form-check-label" for="proses">Pernah</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="f[4]" id="prosesTidak" value="tidak" onclick="onTidakProses()">
                            <label class="form-check-label" for="prosesTidak">Tidak Pernah</label>
                        </div>


                        <p class="w3-text-red " id="tidakProses"></p>
                        <div id="tidakNampak" style="display: none;" class="animated animatedFadeInUp fadeInUp">
                            <p>
                            <p>Apakah Anda pernah menjadi selain Asisten Proses?</p>
                            <p><input type="checkbox" name="f[5]" id="mekanikal" value="Mekanikal" class="w3-check"><label for="mekanikal">Asisten Mekanikal/Pendampingan</label></p>
                            <p><input type="checkbox" name="f[6]" id="Elektrikal" value="Elektrikal" class="w3-check"><label for="Elektrikal">Asisten Elektrikal/Pendampingan</label></p>
                            <p><input type="checkbox" name="f[7]" id="Lab" value="Lab" class="w3-check"><label for="Lab">Asisten Lab/Pendampingan</label></p>
                            <p><input type="checkbox" name="f[8]" id="SPO" value="SPO" class="w3-check"><label for="SPO">Asisten SPO/Pendampingan</label></p>
                            </p>
                            <p>Klik <span class="w3-text-blue" onclick="onLihat('ukMill')" style="cursor: pointer;">disini untuk melihat Unit Kompetensi yang diujikan</span></p>
                            <p>
                                <input type="checkbox" name="setuju" class="w3-check" value=1 onclick="onSetuju('btn2', 'cek2')" id="cek2"> <label for="setuju"> Saya setuju untuk mengikuti Uji Kompetensi ini</label>
                            </p>
                            <button type="submit" class="w3-button w3-round w3-blue" id="btn2" disabled>Submit</button>
                        </div>
                    </form>
                </div>
                <div class="w3-red" id="pesan">
                    <?php if (isset($_GET['pesan'])) {
                        echo $_GET['pesan'];
                    } ?>
                </div>
            </div>
        </div>


        <div class="w3-modal w3-container" id="ukAgro">
            <div class="w3-col l3 m4">
                &nbsp;
            </div>
            <div class="w3-container w3-light-grey w3-col l6 m8 s12 w3-animate-zoom" style="margin-top: 55px;">
                <span class="w3-button w3-xxlarge w3-right" onclick="document.getElementById('ukAgro').style.display='none'">×</span>
                <h2 class="w3-center">Unit Kompetensi Agronomy</h2>
                <div class="w3-white w3-margin w3-padding">
                    <h3>Fundamental 1</h3>
                    <table class="w3-table-all">
                        <tr>
                            <th>#</th>
                            <th>Unit Kompetensi</th>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($uk as $u) {
                            if ($u['fundamental'] == 'F1') {
                                $judul = $u['judul_uk'];
                                echo "<tr>
                                <td>$i</td>
                                <td>$judul</td>
                                </tr>";
                                $i++;
                            }
                        }

                        ?>
                    </table>
                </div>
                <div class="w3-white w3-margin w3-padding">
                    <h3>Fundamental 2</h3>
                    <table class="w3-table-all">
                        <tr>
                            <th>#</th>
                            <th>Unit Kompetensi</th>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($uk as $u) {
                            if ($u['fundamental'] == 'F2') {
                                $judul = $u['judul_uk'];
                                echo "<tr>
                                <td>$i</td>
                                <td>$judul</td>
                                </tr>";
                                $i++;
                            }
                        }

                        ?>
                    </table>
                </div>
                <div class="w3-white w3-margin w3-padding">
                    <h3>Fundamental 3</h3>
                    <table class="w3-table-all">
                        <tr>
                            <th>#</th>
                            <th>Unit Kompetensi</th>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($uk as $u) {
                            if ($u['fundamental'] == 'F3') {
                                $judul = $u['judul_uk'];
                                echo "<tr>
                                <td>$i</td>
                                <td>$judul</td>
                                </tr>";
                                $i++;
                            }
                        }

                        ?>
                    </table>
                </div>
                <div class="w3-button w3-margin w3-green" onclick="document.getElementById('ukAgro').style.display= 'none';">Tutup</div>
            </div>
        </div>
        <div class="w3-modal w3-container" id="ukMill">
            <div class="w3-col l3 m4">
                &nbsp;
            </div>
            <div class="w3-container w3-light-grey w3-col l6 m8 s12 w3-animate-zoom" style="margin-top: 55px;">
                <span class="w3-button w3-xxlarge w3-right" onclick="document.getElementById('ukMill').style.display='none'">×</span>
                <h2 class="w3-center">Unit Kompetensi Mill</h2>
                <div class="w3-white w3-margin w3-padding">

                    <table class="w3-table-all">
                        <tr>
                            <th>#</th>
                            <th>Unit Kompetensi</th>
                        </tr>
                        <?php
                        $i = 1;
                        foreach ($uk as $u) {
                            if ($u['fundamental'] == 'Mill') {
                                $judul = $u['judul_uk'];
                                echo "<tr>
                                <td>$i</td>
                                <td>$judul</td>
                                </tr>";
                                $i++;
                            }
                        }

                        ?>

                    </table>
                </div>

                <div class="w3-button w3-margin w3-blue" onclick="document.getElementById('ukMill').style.display= 'none';">Tutup</div>
            </div>
        </div>
        <div class="w3-modal w3-container" id="status">
            <div class="w3-col l3 m4">
                &nbsp;
            </div>
            <div class="w3-container w3-light-grey w3-col l6 m8 s12 w3-animate-zoom" style="margin-top: 55px;">
                <span class="w3-button w3-xxlarge w3-right" onclick="document.getElementById('status').style.display='none'">×</span>
                <h2 class="w3-center">Masukkan NIK anda :</h2>
                <div class="w3-white w3-margin w3-padding">
                    <form action="status.php" method="post">
                        <p>
                            <input type="text" name="nik" id="nik" class="w3-input w3-border" placeholder="NIK Anda...">
                        </p>
                        <p>
                            Tanggal Asesmen :
                            <input type="date" name="tanggal" id="tanggal" class="w3-input w3-border">
                        </p>
                        <button class="w3-button w3-green" style="margin-bottom: 20px;">Submit</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            function autofillAgro(skema) {
                if (skema == 'Agro') {
                    var nik = $("#nikAgro").val();
                    $.ajax({
                        url: 'autofillAgro.php',
                        data: {
                            'nik': nik,
                        },
                    }).success(function(data) {
                        var json = data,
                            obj = JSON.parse(json);
                        $("#namaAgro").val(obj.nama);
                    });
                }

            }

            function autofillMill(skema) {
                if (skema == 'Mill') {
                    var nik = $("#nikMill").val();
                    $.ajax({
                        url: 'autofillMill.php',
                        data: {
                            'nik': nik,
                        },
                    }).success(function(data) {
                        var json = data,
                            obj = JSON.parse(json);
                        $("#namaMill").val(obj.nama);
                    });
                }

            }

            $(document).ready(function() {
                $('#nikAgro').change(function() {
                    var nik = $(this).val();
                    $.ajax({
                        url: "a_agro.php",
                        method: "post",
                        data: {
                            nik: nik
                        },
                        success: function(data) {
                            $('#asesorAgro').html(data);
                        }
                    })
                })
                $('#nikMill').change(function() {
                    var nik = $(this).val();
                    $.ajax({
                        url: "a_mill.php",
                        method: "post",
                        data: {
                            nik: nik
                        },
                        success: function(data) {
                            $('#asesorMill').html(data);
                        }
                    })
                })
            })

            // function autofillMill(skema) {
            //     if (skema == 'Mill') {
            //         var nik = $("#nikMill").val();
            //         $.ajax({
            //             url: 'autofillMill.php',
            //             data: 'nik=' + nik,
            //         }).success(function(data) {
            //             var json = data,
            //                 obj = JSON.parse(json);
            //             $("#namaMill").val(obj.nama);
            //         });
            //     }

            // }

            // function autofill() {
            //     var nik = $("#nik").val();
            //     $.ajax({
            //         url: 'autofill.php',
            //         data: 'nik=' + nik,
            //     }).success(function(data) {
            //         var json = data,
            //             obj = JSON.parse(json);
            //         $("#nama").val(obj.nama);
            //     });
            // }

            function openSkema(skema) {
                var i;
                var x = document.getElementsByClassName("skema");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                document.getElementById(skema).style.display = "block";
            }

            function onSetuju(btn, cek) {
                var checkBox = document.getElementById(cek);
                var formAgro = document.forms["formAgro"];
                var hitung = 0;
                if (btn == 'btn1') {
                    for (var i = 0; i < 3; i++) {
                        if (formAgro.elements[i].checked) {
                            hitung = hitung + 1;
                        }
                    }
                    if (hitung == 0) {
                        alert("Anda belum memilih Fundamental");
                        document.getElementById("cek1").checked = false;
                        document.getElementById("cek2").checked = false;

                    }
                }
                if (checkBox.checked == true) {
                    document.getElementById(btn).disabled = false;
                } else {
                    document.getElementById(btn).disabled = true;
                }
            }


            function onLihat(uk) {
                document.getElementById(uk).style.display = "block";
            }

            function onTidakProses() {
                document.getElementById("tidakProses").innerHTML = "Anda tidak dapat melanjutkan asesmen, karena belum pernah menjadi asisten proses!";
                document.getElementById("tidakNampak").style.display = "none";
            }

            function onProses() {
                document.getElementById("tidakProses").innerHTML = "";
                document.getElementById("tidakNampak").style.display = "block";
            }

            function onNamaAsesi(str, unit) {
                if (str.length == 0) {
                    document.getElementById("nama").value = "";
                    return;
                } else {
                    const xmlhttp = new XMLHttpRequest();
                    xmlhttp.onload = function() {
                        document.getElementById("nama" + unit).value = this.responseText;
                    }
                    xmlhttp.open("GET", "nama_asesi.php?q=" + str);
                    xmlhttp.send();
                }

            }

            <?php if (isset($_GET['pesan'])) : ?>
                setTimeout(hilangPesan, 5000);

                function hilangPesan() {
                    document.getElementById("pesan").style.display = "none";
                }
            <?php endif; ?>
        </script>
    <?php
    elseif (isset($_GET['selesai'])) :
        include "selesai.php";
    else :
        $slug = $_GET['c'];
        include "ttd.php";
    endif; ?>
</body>

</html>