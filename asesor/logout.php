<?php

setcookie("uji_k", "", time() - 3600, "/");

header("location:login.php?pesan=Terima kasih");
