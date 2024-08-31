<?php
include('../functions.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/w3.css">
    <link rel="stylesheet" href="../styles/font-awesome.min.css">
    <title>Uji Kompetensi - Halaman <?= $level; ?></title>
</head>
    <body class="w3-light-grey">
        <div class="w3-content w3-white w3-padding w3-card w3-round" style="max-width: 800px; margin-top:45px; margin-bottom: 50px;">
            <div class="w3-margin">
                <h1 class="w3-text-blue-grey w3-center">Mill</h1>
                <a href="Index.php">
                    <div class="w3-button w3-red w3-right"> Kembali</div>
                </a>

                <p>File :  </p>
                <table class="w3-table-all w3-hoverable w3-center">
                    <tr>
                        <th>#</th>
                        <th>Nama Asesor</th>
                        <th>Nama Asesi</th>
                        <th>Status</th>
                        <th>File</th>
                    </tr>
                    <?php
                            $sql = "SELECT * FROM uji_asesi";
                            $hasil = $conn->query($sql);   

                            if ($hasil->num_rows > 0) {
                                $i = 1;
                                while ($row = $hasil->fetch_assoc()) {
                                    $nama_asesor = $row['asesor'];
                                    $nama_asesi = $row['nama'];
                                    $status = $row['status'];
                                
                                    echo "<tr>
                                        <td>$i</td>
                                        <td>$nama_asesor</td>
                                        <td>$nama_asesi</td>
                                        <td>$status</td>
                                        <td>
                                            <a href='Mill/APL01.php'>
                                                <button class='w3-button w3-tiny' >APL01</button>
                                            </a>
                                            <a href='Mill/MAK.AM.02.php'>
                                                <button class='w3-button w3-tiny' >MAK.02</button>
                                            </a>
                                            <a href='Mill/MAK.AM.08.php'>
                                                <button class='w3-button w3-tiny' >MAK.08</button>
                                            </a>
                                            <a href='Mill/MAK.AM.09.php'>
                                                <button class='w3-button w3-tiny' >MAK.09</button>
                                            </a>
                                        </td>
                                        </tr>";
                                    $i++;
                                }
                            }
                    ?>
                </table>

            </div>
        </div>
    </body>
</html>