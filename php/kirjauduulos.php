<?php
session_start();
unset($_SESSION["kayttaja"]);
unset($_SESSION["paluuosoite"]);
header("Location:../html/kirjaudu.html");
?>