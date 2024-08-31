<?php
if(isset($_GET['q'])){
$q = $_GET['q'];
include "../functions.php";
$sql = "SELECT id,nama FROM uji_asesi WHERE asesor='$q' and status=2";
$option = "<option value='' selected disabled>pilih Asesi...</option>";
$hasil = $conn->query($sql);
if($hasil->num_rows>0){
    while($row = $hasil->fetch_assoc()){
        $id = $row['id'];
        $nama = $row['nama'];
        $option .= "<option value='$id'>$nama</option>";
    }
}
echo $option;
}