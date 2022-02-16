<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$id=isset($_POST["id"]) ? $_POST["id"] : "";
$etunimi=isset($_POST["etunimi"]) ? $_POST["etunimi"] : "";
$sukunimi=isset($_POST["sukunimi"]) ? $_POST["sukunimi"] : "";
$sähköposti=isset($_POST["sähköposti"]) ? $_POST["sähköposti"] : "";
$puhelinnumero=isset($_POST["puhelinnumero"]) ? $_POST["puhelinnumero"] : "";


if (empty ($id) ||  empty($etunimi) || empty($sukunimi) || empty($sähköposti) || empty($puhelinnumero)){
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


$sql="insert into varaapoyta (etunimi, sukunimi, sähköposti, puhelinnumero, id) values(?, ?, ?, ?)";

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'sdi', $etunimi, $sukunimi, $sähköposti, $puhelinnumero, $id);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);


?>
