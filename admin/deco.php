<?php
session_start();
unset($_SESSION['Webcode']);
session_destroy();
header('Location: index.php');

