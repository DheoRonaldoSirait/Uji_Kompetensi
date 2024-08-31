<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Asesi - Admin</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="../public/logo.png">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="public/css/style.css" />

    <!-- JS -->
    <script src="/js/script.js"></script>

    <!-- JQuery -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <!-- Font Awesome -->
    <link rel=" stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />



</head>

<body style="background-color: #ECEEEE;">

    <?php
    require_once '../functions.php';
    require_once 'editasesidata.php';
    $sql = mysqli_query($conn, "SELECT * FROM data_asisten WHERE id='$_GET[update]'");
    $data = mysqli_fetch_array($sql);
    ?>

    <div class="container shadow-lg bg-light navbar-light rounded-3  animated animatedFadeInUp fadeInUp" style="background-color: white; padding: 30px; margin-bottom: 30px;">

        <form method="POST" action="">
            <div class="mb-3">
                <label for="nik" class="form-label">NIK Asesi </label>
                <input type="text" class="form-control" id="nik" placeholder="Isi NIK Asesor" name="nik" value="<?php echo $data['nik'] ?>" required>
            </div>
            <div class="mb-3 mt-3">
                <label for="nama" class="form-label">Nama Asesi</label>
                <input type="text" class="form-control" id="nama" placeholder="Isi Nama Asesor" name="nama" value="<?php echo $data['nama'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="kebun" class="form-label">Kebun Asesi </label>
                <select name="kebun" placeholder="kebun" class="form-control" required>
                    <option value="" selected disabled>Pilih Kebun Asesi...</option>
                    <option value="Korola">Korola</option>
                    <option value="Toasioko">Toasioko</option>
                </select>
            </div>
            <div class="mb-3 mt-3">
                <label for="skema" class="form-label">Skema Asesi</label>
                <select name="skema" placeholder="skema" class="form-control" required>
                    <option value="" selected disabled>Pilih Skema Asesi...</option>
                    <option value="Agronomy">Agronomy</option>
                    <option value="Mill">Mill</option>
                </select>
            </div>

            <button type="submit" href="index.php" class="btn btn-success" name="proses" value="simpan">Submit</button>
            <button type="button" onclick="location.href='index.php'" class="btn btn-primary">Kembali</button>

        </form>
    </div>





</body>

</html>