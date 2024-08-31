<?php
require_once('cek_sesi.php');
require_once '../functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Admin</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../public/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="../public/css/style.css" />
    <link rel="stylesheet" href="../public/css/w3.css">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">Admin</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Asesi</div>
                        <a class="nav-link" onclick="hide('asesi')">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                            Status BAP
                        </a>
                        <a class="nav-link" onclick="hide('daftarasesi')">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Daftar Asesi
                        </a>
                        <a class="nav-link" href="add_asesi.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-plus"></i></div>
                            Tambah Asesi
                        </a>


                        <div class="sb-sidenav-menu-heading">Asesor</div>
                        <a class="nav-link" onclick="hide('asesor')">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Daftar Asesor
                        </a>
                        <a class="nav-link" href="tambah.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-plus"></i></div>
                            Tambah Asesor
                        </a>

                    </div>
                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard Admin</h1>
                    <ol class="breadcrumb mb-4">
                    </ol>

                    <div>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4" onclick="hide('daftarasesi')">
                                    <div class="card-body">Daftar Asesi</div>
                                    <div class=" d-flex align-items-center justify-content-between">


                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4" onclick="hide('asesor')">
                                    <div class="card-body">Daftar Asesor</div>
                                    <div class="d-flex align-items-center justify-content-between">


                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Asesi -->

                        <div id="asesi" style="display: none;" class="container animated animatedFadeInUp fadeInUp">
                            <form>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Asesi</th>
                                            <th scope="col">Nama Asesor</th>
                                            <th scope="col">CLP</th>
                                            <th scope="col">DPT</th>
                                            <th scope="col">CLO</th>
                                            <th scope="col">DPW</th>
                                            <th scope="col">VPK</th>
                                            <th></th>
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
                                        <td>$i</td>
                                        <td>$nama</td>
                                        <td>$asesor</td>
                                        <td>$CLP</td>
                                        <td>$DPT</td>  
                                        <td>$CLO</td>                  
                                        <td>$DPW</td>                  
                                        <td>$VPK</td>                       
                                        </tr>";
                                            $i++;
                                        }

                                        ?>

                                    </tbody>
                                </table>
                                <div>
                                    <a class="" href="export.php">
                                        <button type="button" class="justify-content-right btn btn-success btn-sm">Export</button>
                                    </a>
                                </div>
                            </form>
                        </div>

                        <!-- Asesi -->

                        <div id="daftarasesi" style="display: none;" class="animated animatedFadeInUp fadeInUp">
                            <form action="editasesidata.php" method="POST">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">NIK Asesi</th>
                                            <th scope="col">Nama Asesi</th>
                                            <th scope="col">Skema</th>
                                            <th scope="col">Kebun</th>
                                            <th scope="col"></th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $data_event = mysqli_query($conn, "select * from data_asisten");
                                        $i = 1;

                                        while ($data = mysqli_fetch_assoc($data_event)) {
                                            $id = $data['id'];
                                            $nik = $data['nik'];
                                            $nama = $data['nama'];
                                            $skema = $data['skema'];
                                            $estate = $data['estate'];


                                            echo "<tr>
                                        <td>$i</td>
                                        <td>$nik</td>
                                        <td>$nama</td>
                                        <td>$skema</td>              
                                        <td>$estate</td>    
                                        <td>
                                        <a href='editasesi.php?update=$id'>
                                            <button type='button' class='btn btn-warning btn-sm' value='edit'>Edit</button>
                                        </a>
                                        </td>
                                        <td>
                                        <a href='?hapusasesi=$id' onClick=\"return confirm('Anda yakin ingin menghapus data asesi?');\">
                                            <button type='button' class='btn btn-danger btn-sm' value='hapus'>Hapus</button>
                                        </a>
                                        </td>          
                                        </tr>";
                                            $i++;
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>

                        <?php
                        if (isset($_GET['hapusasesi'])) {
                            mysqli_query($conn, "DELETE FROM data_asisten WHERE id='$_GET[hapusasesi]'")
                                or die(mysqli_error($conn));

                            echo "<script>alert('Data berhasil dihapus')</script>";
                            echo "<meta http-equiv=refresh content=1;URL='index.php'>";
                        }
                        ?>

                        <!-- Asesor -->

                        <div id="asesor" style="display: none;" class="animated animatedFadeInUp fadeInUp">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NIK</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Tugas</th>
                                        <th scope="col">Kebun</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $data_event = mysqli_query($conn, "select * from uji_asesor");
                                    $i = 1;

                                    while ($data = mysqli_fetch_assoc($data_event)) {
                                        $id = $data['id'];
                                        $NIK = $data['nik'];
                                        $NAMA = $data['nama'];
                                        $TUGAS = $data['tugas'];
                                        $KEBUN = $data['a_estate'];

                                        echo "<tr>
                                        <td>$i</td>
                                        <td>$NIK</td>
                                        <td>$NAMA</td>
                                        <td>$TUGAS</td> 
                                        <td>$KEBUN</td>
                                        <td>
                                        <a href='editasesor.php?updateasesor=$id'>
                                            <button type='button' class='btn btn-warning btn-sm'>Edit</button>
                                        </a>
                                        </td>
                                        <td>
                                        <a href='?hapusasesor=$id' onClick=\"return confirm('Anda yakin ingin menghapus data asesor?');\">
                                            <button type='button' class='btn btn-danger btn-sm' value='hapus'>Hapus</button>
                                        </a>
                                        </td>           
                                        </tr>";
                                        $i++;
                                    }

                                    ?>

                                </tbody>
                            </table>
                        </div>

                        <?php
                        if (isset($_GET['hapusasesor'])) {
                            mysqli_query($conn, "DELETE FROM uji_asesor WHERE id='$_GET[hapusasesor]'")
                                or die(mysqli_error($conn));
                            echo "<script>alert('Data berhasil dihapus')</script>";
                            echo "<meta http-equiv=refresh content=1;URL='index.php'>";
                        }
                        ?>

                    </div>
            </main>



            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">

                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

<script>
    function hide(skema) {
        var x = document.getElementById(skema);
        if (skema === "asesi") {
            var y = document.getElementById("asesor");
            var z = document.getElementById("daftarasesi");
        } else if (skema === "daftarasesi") {
            var y = document.getElementById("asesor");
            var z = document.getElementById("asesi");
        } else {
            var y = document.getElementById("asesi");;
            var z = document.getElementById("daftarasesi");
        }
        x.style.display = "block";
        y.style.display = "none";
        z.style.display = "none";
    }
</script>

</html>