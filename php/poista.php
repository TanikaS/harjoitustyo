<?php

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
//linkki aina GET
$poistettava=isset($_GET["poistettava"]) ? $_GET["poistettava"] : 0 ;

if (empty($poistettava)){
    header("Location:./php/tulostatiedot.php");
    exit;
}

try{
    $yhteys=mysqli_connect("db", "root", "password", "harjoitustyo");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

$sql="delete from varaapoyta where id=?";

$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'i', $poistettava);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);

mysqli_close($yhteys);

header("Location:./tulostatiedot.php");

?>