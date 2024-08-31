<?php
require('../functions.php');
header("Content-type:application/vnd-ms-excel");
header("Content-Disposition:attachment;  filename=laporan BAP.xls");
?>
<html>

<head>
    <title>Data Stock Obat</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />

</head>

<body>
    <div>
        <h1 align='center'>Laporan BAP Asesi </h1>
    </div>

    <div>
        <table border="1" id="" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th align="center">#</th>
                    <th>Nama Asesi</th>
                    <th>Nama Asesor</th>
                    <th>CLP</th>
                    <th>DPT</th>
                    <th>CLO</th>
                    <th>DPW</th>
                    <th>VPK</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data_event = mysqli_query($conn, "select * from uji_keputusan a inner join uji_asesi b on a.id_asesi = b.id and b.bap IS NOT NULL");
                $i = 1;

                while ($data = mysqli_fetch_assoc($data_event)) {
                    $nama = $data['nama'];
                    $asesor = $data['asesor'];
                    $CLP = $data['clp'];
                    $DPT = $data['dpt'];
                    $CLO = $data['clo'];
                    $DPW = $data['dpw'];
                    $VPK = $data['vpk'];


                    echo "<tr>
                                        <td align='center'>$i</td>
                                        <td >$nama</td>
                                        <td>$asesor</td>
                                        <td align='center'>$CLP</td>
                                        <td align='center'>$DPT</td>  
                                        <td align='center'>$CLO</td>                  
                                        <td align='center'>$DPW</td>                  
                                        <td align='center'>$VPK</td>                       
                                        </tr>";
                    $i++;
                }

                ?>

            </tbody>
        </table>
    </div>

    <br>



    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



</body>

</html>