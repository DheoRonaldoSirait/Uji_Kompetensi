<?php

if (isset($_GET['id'])) :

    $id = $_GET['id'];

    include "functions.php";



    $sql = "SELECT nik, nama, fundamental FROM uji_asesi WHERE id = $id";

    $hasil = $conn->query($sql);

    if ($hasil->num_rows > 0) {

        $row = $hasil->fetch_assoc();

        $f = explode(";", $row['fundamental']);

        $nik = $row['nik'];

        $nama = $row['nama'];
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

        <script src="ckeditor/ckeditor.js"></script>



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

            <div class="w3-margin">

                <h1 class="w3-text-blue-grey w3-center">Jawablah pertanyaan berikut:</h1>

                <form action="proses_dpt.php" method="post">

                    <p>

                        NIK : <b><?= $nik; ?></b>

                        <input type="hidden" name="id_asesi" value="<?= $id; ?>">

                    </p>

                    <p>

                        Nama : <b><?= $nama; ?></b>

                    </p>



                    <table class="w3-table-all">

                        <tr>

                            <th>#</th>

                            <th>Pertanyaan</th>



                        </tr>

                        <?php

                        $i = 1;

                        foreach ($f as $fu) {

                            if ($fu !== "") {

                                if ($fu == "Proses") {

                                    $sql = "SELECT * FROM uji_soal_mill ORDER BY RAND()";

                                    $hasil = $conn->query($sql);



                                    while ($row = $hasil->fetch_assoc()) {

                                        $id = $row['id'];

                                        $soal = $row['soal'];

                                        $a = $row['jawaban_a'];

                                        $b = $row['jawaban_b'];

                                        $c = $row['jawaban_c'];

                                        $d = $row['jawaban_d'];



                                        echo "
                                        
                                        <tr class='w3-dark-grey'>

                                        <td>$i</td>

                                        <td>$soal </td>

                                    </tr>

                                    <tr>
                                        <td><input type='radio' name='j[$id]' class='form-check-input' value='A' required /></td>

                                        <td>$a</td>

                                        </tr>

                                        <tr>

                                        <td><input type='radio' name='j[$id]' class='form-check-input' value='B' /></td>

                                        <td>$b</td>

                                        </tr>

                                        <tr>

                                        <td><input type='radio' name='j[$id]' class='form-check-input' value='C' /></td>

                                        <td>$c</td>

                                        </tr>

                                        <tr>

                                        <td><input type='radio' name='j[$id]' class='form-check-input' value='D' /></td>

                                        <td>$d</td>
                                    
                                    </tr>
                                ";

                                        $i++;
                                    }
                                } else {

                                    $sql = "SELECT * FROM uji_soal_f WHERE fundamental = '$fu' ORDER BY RAND()";

                                    $hasil = $conn->query($sql);



                                    while ($row = $hasil->fetch_assoc()) {

                                        $soal = $row['soal'];

                                        $id = $row['id'];



                                        echo "<tr>

                                        <td>$i</td>

                                        <td>$soal</td>

                                    </tr>

                                    <tr>                                        

                                        <td colspan=2><p>Jawaban soal no $i </p><textarea required name='j[$id]' id='j$i'></textarea></td>                                    

                                    </tr>";

                                        $i++;
                                    }
                                }
                            } else {
                            }
                        }

                        echo "<input id='jml' type='hidden' value=$i />";

                        ?>

                    </table>

                    <button type="submit" id="btn" class="w3-button w3-green w3-margin">Submit</button>

                </form>

            </div>

        </div>



        <script>
            jmlSoal = document.getElementById('jml').value;

            lembarJawaban(jmlSoal);



            function lembarJawaban(jmlSoal) {

                var i;

                for (i = 1; i < jmlSoal; i++) {

                    // CKEDITOR.replace('j' + i);

                    var editor = CKEDITOR.replace('j' + i, {
                        language: 'en',
                        extraPlugins: 'notification'
                    });



                }

                editor.on('required', function(evt) {
                    editor.showNotification('Masih terdapat jawaban kosong', 'warning');
                    evt.cancel();
                });

            }

            // var a = 0;
            // const radio = document.querySelectorAll('input[name="j[$id]"]');

            // function confirmation() {
            //     for (var i = 0; i < radio.length; i++) {
            //         if (radio[i].checked) {
            //             a = 1;
            //             document.getElementById('btn1').disabled = !this.checked;
            //             break;
            //         }
            //     }
            //     if (a == 0) {
            //         alert("Jawaban Masih Kosong!");
            //         document.getElementById("btn1").disabled = true;

            //         document.getElementById("cek1").checked = false;
            //     }
            // }
        </script>

    </body>



    </html>

<?php

else :

    header("location:index.php?pesan=Anda Belum melakukan CLP");

endif;

?>