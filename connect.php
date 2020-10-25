<?php

$base= mysqli_connect('127.0.0.1', "root", "", "test1");
 
/* Vérification de la connexion */
if (mysqli_connect_errno()) {
    printf("Échec de la connexion : %s\n", mysqli_connect_error());
    exit();
}
$varnom = 'TANGORYTHM'; //votre nom de societe
$varadresse1 = 'Liberty Street Djerba Midoun 4116 Tunisia '; //Votre premiere ligne d'adresse
$varadresse2 = '5 Am Hesselter, 6171 Godbrange, Luxembourg'; //votre seconde ligne d'adresse
$vartelephone = '+216 21 445 398'; //votre numero de telephone
$varmail = 'info@tangorythm.com'; // votre adresse e-mail
?>

