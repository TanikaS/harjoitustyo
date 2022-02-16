<?php
include "../html/header.html";
?>

<?php
try{
    $yhteys=mysqli_connect("db", "root", "password", "harjoitustyo");
}
catch(Exception $e){
    print "Yhteysongelma";
    print "<a href='../html/varaapoyta.html'>Takaisin lomakkeeseen</a>";
    include "../html/footer.html";
    exit;
}
$tulos=mysqli_query($yhteys, "select * from varaapoyta");

while ($rivi=mysqli_fetch_object($tulos)){
    print "<p>$rivi->etunimi <br> $rivi->sukunimi <br> $rivi->sähköposti <br> $rivi->puhelinnumero <br> <a href='./muokkaa.php?muokattava=$rivi->id'>Muokkaa</a></p>";
}

mysqli_close($yhteys);
?>
<?php 
include "../html/footer.html";
?>