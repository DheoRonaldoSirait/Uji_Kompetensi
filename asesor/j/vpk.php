<?php
$level = "";
require "../../functions.php";
if(isset($_COOKIE['uji_k'])){
    $cook = $_COOKIE['uji_k'];  
    $data = explode("&", $cook);
    $nik = $data[0];
    $sesi = $data[1];
    $sql = "SELECT * FROM uji_asesor WHERE nik='$nik' and sha='$sesi' and is_active=1 LIMIT 1";
    $hasil = $conn->query($sql);
    if($hasil->num_rows>0){
        $level = "Asesor";
    }
}
if($level === "Asesor"):
    if(isset($_GET['id'])):
    $id = $_GET['id'];
    $f = explode(";", $_GET['f']);   
    $uji_soal = "uji_soal_f";
    foreach($f as $v){
        $fund[] = "fundamental='".$v."'";
    }
    
    $fundamental = implode(" OR ",$fund);
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

    <title>Uji Kompetensi - VPK</title>
</head>

<body class="w3-light-grey">
<div class="w3-content w3-white w3-padding w3-card w3-round" style="max-width: 800px; margin: 45px auto;">
     <div class="w3-margin">
         <h2>Verifikasi Pihak Ketiga untuk <?=$row['nama'];?></h2>
         <form action="valid_vpk.php" method="post" id="frm1">
             <input type="hidden" name="id_asesi" value="<?=$row['id'];?>">
             <input type="hidden" name="id_asesor" value="<?=$nik;?>">
         <table class="w3-table-all">
             <tr>
                 <th>#</th>
                 <th>Item yang diverifikasi</th> 
                 <th>Score</th>                
             </tr>
<?php
$sql = "SELECT * FROM uji_soal_vpk WHERE $fundamental ";
$hasil = $conn->query($sql);
$jml = $hasil->num_rows;
$i=1;
while($row = $hasil->fetch_assoc()){
    $soal = $row['soal'];
    $id_soal = $row['id'];
    $kode = $row['kode'];
    
    if(empty($id_soal_asesi)){
        $jawaban = "";
    }   
    
    echo "<tr>
            <td>$i</td>
            <td>$soal </td>
            <td><input type='checkbox' name='score[$id_soal]' class='w3-check' value=1 /></td>
        </tr>
        
        ";
        $i++;
}


?>
    </table>
    <p>
        <input type="checkbox" name="cek" id="cek" onchange="onHitung()" class="w3-check"> Cek disini untuk perhitungan Total Score
    </p>
    <p>Total Score <input style='max-width:40px;' name='total_score' id="total_score" value='' /><span id="lanjut"></span></p>
   <input type="hidden" name="keputusan" value="" id="keputusan" />
    
    <button type="submit" class="w3-button w3-green" style="margin-top: 20px;" id='btn1' disabled>Submit</button>
    </form>
    </div>
</div>
<script>
   function onHitung(){
            var jmlCek = <?=$jml;?>;
            var x = document.forms["frm1"];
            var hasil = 0;
            var pass = jmlCek*0.8;
            var i;  
            for (i = 2; i < jmlCek + 2 ;i++) {
                if(x.elements[i].checked){
                    hasil = hasil + 1;	                
                }  
            }
            
            document.getElementById("total_score").value = hasil;
            if (hasil < pass){
                document.getElementById("keputusan").value = "BK";
                document.getElementById("lanjut").innerHTML = "dari "+ jmlCek + ", Belum Kompeten";
            }  else {
                document.getElementById("keputusan").value = "K";
                document.getElementById("lanjut").innerHTML = "dari "+ jmlCek + ", Kompeten";
            }
            document.getElementById('btn1').disabled = false;
            
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
