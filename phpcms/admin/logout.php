<?php
session_start();
session_destroy();
unset($_SESSION['Admin']);
header('Location:../login.php');