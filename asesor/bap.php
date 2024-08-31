<?php
if(isset($_POST)){
    $bap = $_POST['bap'];
    if(empty($bap)){
        header("location:index.php?pesan=Anda belum memilih Asesi yang akan di BAP");
    }
    $tanggal = date("Y-m-d");
    $w=[];
    foreach($bap as $b=>$k){
        $w[] = "id = $k";
    }
    $where = implode(" OR ", $w);
    include "../functions.php";
    $sql = "UPDATE uji_asesi SET bap = '$tanggal', status=3 WHERE $where ";
    if($conn->query($sql)){
        header("location:index.php?pesan=Asesi telah di BAP");
    }else{
        var_dump($sql);
    }
}