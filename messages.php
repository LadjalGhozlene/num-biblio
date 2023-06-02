<?php

session_start();
include("modele/lecteur.php");
include("modele/fonctionmenu.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="CSS/bootstrap/css/bootstrap.min.css"/>
<link rel="stylesheet" href="CSS/theme.css"/>
<link rel="stylesheet" href="CSS/profile1.css"/>
<script type="text/javascript" src="JQ/jquery-2.2.1.min.js"></script>
  <title>Bibliotheuqe Numérique</title>
</head>

<body>
<div class="jumbotron">
      <div class="col-lg-8">
          <img src="IMG/logo.svg" height="90" alt=""/>
      </div>
</div>
<div class="col-lg-3">
<div class="panel">
	<div class="panel-heading">
		<img src="Auteurs/8.jpg" class="img-circle" width="50" alt=""/>
		<?php
		if (isset($_SESSION['nom_lecteur']))
		{
			echo "<h2>".$_SESSION['nom_lecteur']."&nbsp;".$_SESSION['prenom_lecteur']."</h2>";
		}
		else 
		{
			header('Location: index.php');exit();
		}
		?>
	</div>
	<div class="panel-body">
<nav id="navigation" class="table-responsive">
  <ul>
    <li><a href="profil.php"><h4 class="glyphicon glyphicon-dashboard">&nbsp;Tableau_de_board</h4></a></li>
    <li><a href="index.php"><h4 class="glyphicon glyphicon-home">&nbsp;Accueil</h4></a></li>
    <li><a href="messages.php"><h4 class="glyphicon glyphicon-envelope">&nbsp;Messages</h4></a></li>
    <li><a href="modification.php"><h4 class="glyphicon glyphicon-edit">&nbsp;Modification</h4></a></li>
    <li><a href="index.php?d=true" ><h4 class="glyphicon glyphicon-log-out">&nbsp;Logout</h4></a></li>
  </ul>
</nav>
	</div>
</div>
</div>
<div class="col-lg-8"><hr>
<div class="panel panel-danger">
  <div class="panel-heading">MES MESSAGES </div>
  <div class="page-header">
  <h1><small><?php delai(); ?></small></h1> 
</div>
    
  </div>
</div>
<div class="col-lg-12">
<footer class="footer">
<?php include('composant/footer.php');?>
</footer>
</div>

</body>
</html>


<?php
function delai()
{

  $cli=new lecteur();
  $res=$cli->livre_emprunt($_SESSION['id_lecteur']);

  foreach ($res as $emprunt) 
  {

  $z=$emprunt['date_emprunt'];
  $DateFin=8;
  $DateDebut = date("$z");
  $DateFin = date('Y-m-d', strtotime($DateDebut.' +'.$DateFin.' days'));


  if($DateFin < date('Y-m-d'))
    {
    echo "<div class='panel-danger' align='center'>Vous avez dépassé le date du retour du livre  " .$emprunt['isbn']." !</div><br/>";
    }
  else
    {
	  echo "<div class='panel-danger' align='center'> Vous n'avez aucun message pour le moment </div>";

    }
  }
}
?>