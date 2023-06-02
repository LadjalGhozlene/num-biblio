<?php
session_start();


include("modele/lecteur.php");

if(!isset($_SESSION['connecter'])) 
  $_SESSION['connecter']=false; 


if(!empty($_POST['user']) AND !empty($_POST['psw']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['date_naissance']) AND !empty($_POST['email'])){

  $lecteur=new lecteur();
    try
    {
        if(1)
        {    
            $lecteur->inscription($_POST['nom'], $_POST['prenom'], $_POST['user'], $_POST['email'], $_POST['date_naissance'], $_POST['addresse'], $_POST['psw']);
        }
        else
        {
            throw new Exception('Un probleme est produit lors de votre inscription!!! Merci de ressayer plus tard ^_^');
        }
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
}

?>



<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" href="CSS/theme.css"/>
<script type="text/javascript"></script>
  <title>Bibliotheuqe Numérique</title>
</head>
<body>

<div class="jumbotron">
      <div class="col-lg-8">
          <img src="IMG/logo.svg" height="90" alt=""/>
      </div>
</div>

<div class="col-lg-6">
  <ul class="nav nav-pills">
      <li><a href="index.php">Acceuil</a></li>
       <?php 

  if(!$_SESSION['connecter']){
  ?>
      <li class="active"><a href="inscription.php">Inscription</a></li>
    <?php
  }
    ?> 

      <li><a href="reglement.php" >Reglement</a></li>
      
      <li><a href="bibliotheque.php" >La bibliotheque</a></li>
  </ul>
</div>



<div class="col-lg-6">
 <div id="iscri">
  <?php 
  if(!$_SESSION['connecter']){
  ?>
        <form method="post" action="index.php" > 
            <input type="text" name="user" placeholder="User" required />
            <input type="password" name="psw" placeholder="Mot de passe" required />
            <input type="submit" value="Se Connecter"/>
        </form>  
      
    <?php
  }else{
    ?> 

 <div class="col-lg-7">
 </div>
 <div class="col-lg-5">
 <ul class="nav nav-pills">
      <li  class="active"><a href="profil.php" >Profile</a></li>
      <li><a href="index.php?d=true" >Deconnecter</a></li>
 
  </ul>

</div>

<?php

}

?>

    </div> 
</div>


<div class="row">
  <div class="col-lg-12">
<div class="panel panel-success panel1" >
 <div class="panel-heading"><h3>Inscription</h3></div>
  <div class="panel-body">
   <fieldset>
    <form action="inscription.php" method="post">
	 <table class="login_table">
	 <tr><td><input type="text" name="nom" id="nom" placeholder="Nom &nbsp;*" required></td></tr>
	 <tr><td><input type="text" name="prenom" id="prenom" placeholder="Prénom &nbsp;*" required></td></tr>
	 <tr><td><input type="text" name="user" id="user" placeholder="User &nbsp;*" required></td></tr>
	 <tr><td><input type="email" name="email" id="email" placeholder="Email &nbsp;*" required></td></tr>
	 <tr><td><input type="password" name="psw" id="password" placeholder="Mot de passe &nbsp;*" required></td></tr>
	 <tr><td><input type="password" name="psw1" id="password1" placeholder="Confirmation &nbsp;*" required></td></tr>
	 <tr><td><input type="date" name="date_naissance" id="date" placeholder="Date de naissance &nbsp;*" required></td></tr>
	 <tr><td><input type="text" name="addresse" id="addresse" placeholder="Adresse &nbsp;*" required></td></tr>
	 <tr><td><small>Se Souvenir de moi &nbsp;</small><input type="checkbox" name="keep" value="true"></td></tr>
	 <tr><td><input type="submit" value="Inscription"/><input type="reset" value="Annuler"/></td></tr>
		</tr>
	 </table>
	</form>
   </fieldset>
<hr>
<div id="reglement_ecrire"><h2>Carte « Adhérent »</h2>
  <ul>
   <li>
	   Une carte « Adhérent » sera délivrée aux usagers n’appartenant pas à l’Université Badji Mokhtar Annaba. Cette carte doit être présentée à chaque visite de la bibliothèque et est obligatoire pour toute opération de prêt.
   </li>
  </ul>
</div>
  </div>
</div>
     
  </div>
</div>
<?php
include('composant/footer.php')
?>
</body>
</html>




