<?php

setcookie("uji_a", "", time() - 3600, "/");

header("location:login.php?pesan=Terima kasih");
