

<?php
ob_start();
include('connect.php');

?>

<?php
$retour1 = mysqli_query($base,'SELECT * FROM document ORDER BY id DESC LIMIT 1');
$donnees1 = mysqli_fetch_array($retour1);

$choix=$_GET['choix'];

$id = $donnees1['id'];
$idclient=$donnees1['id_client'];

$retour2 = mysqli_query($base,'SELECT * FROM client WHERE id = '.$idclient);
$donnees3 = mysqli_fetch_array($retour2);



$retour = mysqli_query($base,'SELECT COUNT(*) AS nb FROM produit');
$donnees2 = mysqli_fetch_array($retour);

$i2 = $donnees2['nb'];

$i = 1;
$totale=0 ;
$totalet=0;

while($i <= $i2)
{
    
    $nom=$_GET['nom'.$i];
    $prix=$_GET['prix'.$i];
    $quantite=$_GET['nombre'.$i];
    $prixtotale = $quantite * $prix ; 
    
    $totale=$totale+$prixtotale ;
if ($quantite >= 1){
$requete = "INSERT INTO `document_produit` VALUES (NULL,'$nom','$prix','$prixtotale','$id','$quantite');"; 
$result = mysqli_query($base , $requete);

   
}
     $i++;
}
$totalet=$totale+($totale*0.1) ;


$sql = "UPDATE `document` SET `totale` = '$totale', `totale_tva` = '$totalet', `type` ='$choix' WHERE `id` = '$id'"; 
$result = mysqli_query($base , $sql);


?>

<?php
$retour3 = mysqli_query($base,'SELECT * FROM document WHERE id = '.$id);
$donnees4 = mysqli_fetch_array($retour3);

?>
<br>
<br>
<br>
<br>
<img src='images/tango.png' width='160' > 

<?php 
if ($choix == "FACTURE"){?>
<h5 align="center">N°DEVIS:<?php echo $id; ?></h5>
<?php
}
else
{?>
<h5 align="center">N°<?php echo $choix; ?>:<?php echo $id; ?></h5>
<?php
}?>
<h5 align="center">Date: <?php echo $donnees4['date']; ?></h5>

<table style="margin-top:40px">
<tr>
<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-xlarge.css" />
		</noscript>

<div style="   margin-left: 10%;display:flex;" class="row">
<table class="col-md-6" style="margin-top:40px">
<tr>
 <td width='230'>
 <?php echo $varnom; ?><br>
 <?php echo $varadresse1; ?> <br>
 <?php echo $varadresse2; ?> <br>
 <?php echo $varmail; ?><br>
 <?php echo $vartelephone; ?> <br>
 </td>               
</tr>
</table>

<div>
<table style="margin-left:900px">
 <tr>
  <td width='230'>
  <?php echo $donnees3['nom']; ?>&nbsp;<?php echo $donnees3['prenom']; ?><br> 
  <?php echo $donnees3['email']; ?><br>
  <?php echo $donnees3['adresse']; ?><br>
  <?php echo $donnees3['gsm']; ?><br>    
  </td>               
 </tr>
</table>
</div>

<div align="center">
<table   style="margin-top:90px ;" >
<tr><th width='300'> Nom de produit </th><th width='200'> Prix unitaire </th><th width='200'> Quantit&eacute; </th><th width='200'> Prix Totale </th></tr>
<?php

$ret = 'SELECT * FROM document_produit WHERE id_doc = '.$id;
$do = mysqli_query($base,$ret);
while($don = mysqli_fetch_array($do)){
echo '<tr><th>';
echo $don['nom_produit'];
echo '</td><th>';
echo $don['prix_produit'].' DT';
echo '</td><th>';
echo $don['quantit'];
echo '</td><th>';
echo $don['prixtotale_produit'].' DT';
echo '</th></tr>';
}
?>
</table>
    <br>
    <br>
<table style="margin-left:300px" ><tr><td width='400'></td><td style="background: #cccccc;"><b>TOTAL HTVA:<?php echo $donnees4['totale']; ?>&nbsp;DT </b></td></tr><tr><td width='400'></td><td style="background: #cccccc;"><b>TVA: 19%</b></td></tr><tr><td width='400'></td><td style="background: #cccccc;"><b>Total T.T.C: <?php echo $donnees4['totale_tva']; ?>&nbsp;DT</b></td></tr></table>
</div>

<br><br><br><br><br><br><br><br>
<div align="center"> <button type="button"><a href="#" OnClick="javascript:window.print()">Payer</a></button>

<div align="center"> <p>pour plus d'information contacter Tangorythm</p></div>

<br><br>
<?php



include('generation_pdf.php');

?>

