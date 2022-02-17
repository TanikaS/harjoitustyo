<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' type='text/css' media='screen' href='../css/menupage.css'>
    <title>SITKO - MENU</title>
</head>
    <body class="all">
        <header>
            <a href="index.html" target="_blank"> <img src="../images/logo.jpg" class="img1" alt=logo ></a>
        </header>
    
        <div class="all-body">
    
            <section class="all-content">
      <div>

<?php

$muokattava=isset($_GET["muokattava"]) ? $_GET["muokattava"] : "";

//Jos tietoa ei ole annettu, palataan listaukseen
if (empty($muokattava)){
    header("Location:./tulostatiedot.php");
    exit;
}



mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
try{
    $yhteys=mysqli_connect("db", "root", "password", "harjoitustyo");
}
catch(Exception $e){
    header("Location:../html/yhteysvirhe.html");
    exit;
}

$sql="select * from varaapoyta where id=?";
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttuja sql-lauseeseen
mysqli_stmt_bind_param($stmt, 'i', $muokattava);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Koska luetaan prepared statementilla, tulos haetaan
//metodilla mysqli_stmt_get_result($stmt);
$tulos=mysqli_stmt_get_result($stmt);
if (!$rivi=mysqli_fetch_object($tulos)){
    header("Location:../html/tietuettaeiloydy.html");
    exit;
}
?>



<form action='./paivitatiedot.php' method='post'>
<input type='hidden' name='id' value='<?php print $rivi->id;?>' readonly><br>
Etunimi:<input type='text' name='nimi' value='<?php print $rivi->etunimi;?>'><br>
Sukunimi:<input type='text' name='sukunimi' value='<?php print $rivi->sukunimi;?>'><br>
Sahkoposti:<input type='text' name='sahkoposti' value='<?php print $rivi->sahkoposti;?>'><br>
Puhelinnumero:<input type='text' name='puhelinnumero' value='<?php print $rivi->puhelinumero;?>'><br>
<input type='submit' name='ok' value='ok'><br>
</form>

<!-- loppuun uusi php-osuus -->
<?php
//Suljetaan tietokantayhteys
mysqli_close($yhteys);
?> 


     
    </div>
    
            </section>
    
            <div class="all-sidebar-1 all-sidebar">
                <ul>
                    <li><a href="index.html">ETUSIVU</a></li>
                    <li><a href="menupage.html">MENU</a></li>
                    <li><a href="varaapoyta.html">VARAA PÖYTÄ</a></li>
                  </ul>
            </div>
    
            <div class="all-sidebar-2 all-sidebar">
                <h4>SITKO PIZZA
                    TAMPERE </h4>
                   <address> Näsilinnankatu 22 <br>
                    33210 Tampere </address> <br> 
                
                    <h4>AUKIOLO</h4>    
                    <p>MA-TO 12–20 <br>
                    PE 11–21<br>
                    LA 12–21<br>
                    SU 13–20 </p> <br>               

                    <h4>YHTEYSTIEDOT</h4>
                    <address>
                   +358 40 550 6499 <br>
                   sitko@ravintolasitko.fi </address>
                
            </div>
    
        </div>
    
        <footer>
            <h3>SEURAA MEITÄ</h3>
            
            <a href="https://www.instagram.com/sitkopizza/?hl=en" target="_blank"><img src="https://sitko.pizza/wp-content/uploads/2021/12/instagram-1.svg"  class="img2" alt="ig"> </a>
            <a href="https://www.facebook.com/sitkopizza/" target="_blank"><img src="https://sitko.pizza/wp-content/uploads/2021/12/facebook-1.svg"  class="img2" alt="fb"></a>
       
        </footer>
   

</body>
</html>