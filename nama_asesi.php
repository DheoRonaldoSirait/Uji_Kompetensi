<?php
if(isset($_GET['q'])){
   include "functions.php";
   $nik = $_GET['q'];
   $sql = "SELECT nama FROM uji_data_asisten WHERE nik = $nik";
   $hasil = $conn->query($sql);
   $cek = $hasil->num_rows;
   if($cek > 0){
      $row = $hasil->fetch_assoc();
      echo $row['nama'];
   }
}