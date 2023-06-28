<?php
session_start();
unset($_SESSION["s_usuario"]);
unset($_SESSION["s_tipo_user"]);
session_destroy();
header("Location:../index.html");
?>