<!DOCTYPE html>
<?php
if (!isset($_COOKIE['uji_k'])) :
?>
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


        <title>Login - Asesor</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="../public/logo.png">
    </head>

    <body class="w3-light-grey">

        <section class="h-100 ">
            <div class="container h-100 ">
                <div class="row justify-content-sm-center h-100 ">
                    <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9 animated animatedFadeInUp fadeInUp">
                        <div class="text-center my-5">
                            <img src="../public/logo.png" alt="logo" width="150">
                        </div>
                        <div class="card shadow-lg ">
                            <div class="card-body p-5">
                                <h1 class="fs-4 card-title fw-bold mb-4">Login Asesor</h1>
                                <form autocomplete="off" method="POST" name="login" action="cek_login.php">
                                    <div class="mb-3">
                                        <label class="mb-2 text-muted" for="nik">NIK </label>
                                        <input autocomplete="off" type="text" class="form-control" placeholder="NIK" name="nik" id="nik">
                                    </div>

                                    <div class="mb-3">
                                        <div class="mb-2 w-100">
                                            <label class="text-muted" for="password">Password</label>
                                        </div>
                                        <input autocomplete="off" type="password" class="form-control" placeholder="password" name="pass" id="">
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary  " name="login">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer py-3 border-0">
                                <div class="text-center">
                                    <div class="w3-red">
                                        <?php if (isset($_GET['pesan'])) {
                                            echo $_GET['pesan'];
                                        } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>


        <!-- <div class="w3-content w3-white w3-padding w3-card w3-round" style="max-width: 800px; margin-top:45px; margin-bottom: 50px;">
            <div class="w3-margin">
                <h1 class="w3-text-blue-grey w3-center">Selamat Datang Asesor, silakan Login terlebih dahulu</h1>
                <div class="w3-red">
                    <?php if (isset($_GET['pesan'])) {
                        echo $_GET['pesan'];
                    } ?>
                </div>
                <form action="cek_login.php" method="post">
                    <p>
                        <input type="text" name="nik" id="nik" class="w3-input w3-border" placeholder="Masukkan NIK Anda...">
                    </p>
                    <p>
                        <input type="password" name="pass" id="pass" class="w3-input w3-border" placeholder="Masukkan Password Anda...">
                    </p>
                    <button class="w3-button w3-green" type="submit">Login</button>
                    <div class="w3-button w3-red" onclick="location.href='../newIndex.php'">Halaman Awal</div>
                </form>
            </div>
        </div> -->
    </body>

    </html>
<?php
else :
    $nama = $_COOKIE['uji_k'];

    header("location:cek_login.php?$nama");
endif;
?>