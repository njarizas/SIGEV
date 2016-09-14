<?php
  session_start();
  session_destroy();
  echo "<script>window.location='iniciar-sesion.php';</script>";