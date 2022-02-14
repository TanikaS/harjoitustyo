<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$etunimi=isset($_POST["etunimi"]) ? $_POST["etunimi"] : "";
$sukunimi=isset($_POST["sukunimi"]) ? $_POST["sukunimi"] : "";
$s�hk�posti=isset($_POST["s�hk�posti"]) ? $_POST["s�hk�posti"] : "";
$puhelinnumero=isset($_POST["puhelinnumero"]) ? $_POST["puhelinnumero"] : "";


if (empty($etunimi) || empty($sukunimi) || empty($s�hk�posti) || empty($puhelinnumero)){
    header("Location:../html/varaapoyta.html");
    exit;
}

try{
    $yhteys=mysqli_connect("db", "root", "password", "harjoitustyo");
}

 catch(Exception $e){
  header("Location:../html/yhteysvirhe.html");
    exit;
 }


$sql="insert into varaapoyta (etunimi, sukunimi, s�hk�posti, puhelinnumero) values(?, ?)";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'si', $etunimi, $sukunimi, $s�hk�posti, $puhelinnumero);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);


?>
