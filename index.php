<?php
session_start();
include("modele/lecteur.php");
include("modele/Livre.php");
if(isset($_GET['passer'])){
if($_GET['passer']=='next'){
$_SESSION['next']=$_SESSION['next']+6;
$_SESSION['nex']=$_SESSION['nex']+6;
}
	else
	{
		if($_GET['passer']=='previous')
		{
			$_SESSION['next']=$_SESSION['next']-6;
			$_SESSION['nex']=$_SESSION['nex']-6;
		}
	}
}
if(isset($_SESSION['connecter']))
{
	if(isset($_GET['d']))
	{
		session_destroy();
		$_SESSION['connecter']=false;
	}
}
if(!isset($_SESSION['connecter'])) 
  $_SESSION['connecter']=false; 
if(!empty($_POST['user']) AND !empty($_POST['psw'])) 
{
	$lecteur1=new lecteur();
    if($lecteur=$lecteur1->valide($_POST['user'],$_POST['psw']))
	{
		$_SESSION['connecter']=true;
		foreach ($lecteur as $lecteur_connecter)
		{
			$_SESSION['id_lecteur']=$lecteur_connecter['id_lecteur'];
			$_SESSION['nom_lecteur']=$lecteur_connecter['nom_lecteur'];
			$_SESSION['prenom_lecteur']=$lecteur_connecter['prenom_lecteur'];
			$_SESSION['user']=$lecteur_connecter['user'];
			$_SESSION['email']=$lecteur_connecter['email_lecteur'];
			$_SESSION['date_naissance']=$lecteur_connecter['date_naissance'];
			$_SESSION['adresse']=$lecteur_connecter['adresse'];
			$_SESSION['psw']=$lecteur_connecter['psw'];
			$_SESSION['nb_emprunt']=$lecteur_connecter['nb_emprunt'];
			$_SESSION['date_inscription']=$lecteur_connecter['date_inscription'];
		}
	}
	else
	{
?>      
    <script type="text/javascript"> window.alert('User ou Mot de passe incorrect! ');</script>
<?php   
    }
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="CSS/theme.css"/>
    <script type="text/javascript" src="JQ/jquery-2.2.1.min.js"></script>
  <title>Bibliotheuqe Numérique</title>
</head>
<body>
<div class="jumbotron">
      <div class="col-lg-8">
          <img src="IMG/logo.svg" height="90" alt=""/>
      </div>
</div>
<div class="col-lg-6">
  <ul class="nav nav-pills nav1">
            <li class="active"><a href="index.php">Acceuil</a></li>
   <?php 
 
  if(!$_SESSION['connecter'])
  {
  ?>
           <li><a href="inscription.php">Inscription</a></li>
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
        <form class="form-horizontal" method="post" action="" enctype="multipart/form-data"> 
            <input type="text" name="user" placeholder="User" required />
            <input type="password" name="psw" placeholder="Mot de passe" required />
            <input type="submit" value="Se connecter"/>
        </form>  
      
    <?php
  }else{
    ?> 

 <div class="col-lg-7">
 </div>
 <div class="col-lg-5">
 <ul class="nav nav-pills">
      <li class="active"><a href="profil.php" >Profile</a></li>
      <li><a href="index.php?d=true" >Deconnecter</a></li>
  </ul>

</div>

    <?php
    }
	 ?>

  </div> 
</div>

<div class="row">

<?php
include("composant/menu.php");
?>

  <div class="col-lg-9">
  <h2> Acceuil</h2>
    <div class="panel panel-default panel2">
      <div class="panel-heading">Page d'Acceuil</div>
      <div class="panel-body">
        <div class="row">
          

<?php
$liv = new Livre();
if(isset($_GET['passer']) AND $_GET['passer']=='next'){
$liv->next($_SESSION['next'],$_SESSION['nex']);
}else{ 
  if(isset($_GET['passer']) AND $_GET['passer']=='previous'){
$liv->previous($_SESSION['next'],$_SESSION['nex']);

  }else{

    $_SESSION['next']=0;
    $_SESSION['nex']=6;
  }
}

if(!isset($_GET['chercher'])){
$chercher="";
}else {$chercher = $_GET['chercher'];}
if(!isset($_GET['id_auteur'])){
$id_auteur="";
}else {$id_auteur = $_GET['id_auteur'];}
if(!isset($_GET['id_cat'])){
$id_cat="";
}else {$id_cat = $_GET['id_cat'];}
$leslivre = $liv->afficher($chercher, $id_auteur, $id_cat, $_SESSION['next'],$_SESSION['nex']);
$annule_next=0;
 foreach($leslivre as $livre){
?>
            <div class="col-sm-6 col-md-4 book1">
              <div class="thumbnail height">
                <?php echo '<img src='.$livre['img_livre'].' alt="" />'; ?>
                    
                <div class="caption">
                 <div class="text-info"><b><?php echo $livre['titre_livre'] ?></b></div>
                    <p><?php echo substr($livre['description'], 0, 300); ?>"</p>
                  <a href="consultation.php?isbn=<?php echo $livre['isbn'] ?>" class="btn btn-primary" role="button">Consulter</a> <?php if($_SESSION['connecter']==true && $livre['etat']==0 ){?><a href="consultation.php?isbn=<?php echo $livre['isbn'] ?>" class="btn btn-default" role="button">emprunter</a>
                      <?php } ?>
                </div>
              </div>
            </div>
           
<?php $annule_next++;} if ($annule_next == 0)
 {
	 echo "<div class='panel alert-warning' align='center'>";
	 echo "<h3> OOPS ! </h3>";
	 echo "Aucun document ne correspond aux termes de recherche spécifiés </div>";} ?>

          </div>
            <ul class="pager">

    <?php if($_SESSION['next']!=0){ ?>
              <li><a href="index.php?chercher=<?php echo $chercher; ?>&passer=previous">Previous</a></li>

              <?php } 
              if($annule_next>=6){ 
                ?>
              <li><a href="index.php?chercher=<?php echo $chercher; ?>&passer=next">Next</a></li>
             <?php } ?>
            </ul>
      </div>
    </div>
  </div>
</div>


<?php
include('composant/footer.php');

?>
</body>
</html>










