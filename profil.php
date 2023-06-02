<?php
//definition pour les emprunt et definition pour l'utilisateur
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
<div class="panel panel-primary">

  <div class="panel-heading">MES EMPRUNTS </div>
  <table class="table">
	  <tr>
		  <th>#</th>
		  <th>Titre</th>
		  <th>Catégorie</th>
		  <th>Date Emprunt</th>
		  <th>Date de retour</th>
	  </tr>

<?php
	  if ($_SESSION['nb_emprunt'] == 0)
	  {
		  echo
		  "<tr>
		    <td colspan='5' align='center'><h3> - Vous n'avez pas des livres empruntés ! - </h3></td>
		  </tr>";
	  }

$lecteur1=new lecteur();
$resulta=$lecteur1->livre_emprunt($_SESSION['id_lecteur']);
foreach ($resulta as $emprunt) {
$z=$emprunt['date_emprunt'];
$id_cat=$emprunt['id_cat'];
$image=$emprunt['img_livre'];
$DateFin=8;
$DateDebut = date("$z");
$DateFin = date('Y-m-d', strtotime($DateDebut.' +'.$DateFin.' days'));
	$catt=new fonction();
	if ($res = $catt->affcat($id_cat))
		{foreach ($res as $menu_aut){$intitule_cat = $menu_aut['intitule_cat'];}}
	?>
  <tr>
         <td align='center'><img src='<?php echo $image;?>' height="100" alt=''/></td>
		 <td><?php echo $emprunt['titre_livre']; ?></td>
		 <td><?php echo $intitule_cat; ?></td>
		 <td align='center'><?php echo $emprunt['date_emprunt']; ?></td>
		 <td align='center'><?php echo $DateFin; ?> </td>
		</tr><?php } ?>
    
  </table>
  </div>
</div>
<div class="col-lg-12">
<footer class="footer">
<?php include('composant/footer.php');?>
</footer>
</div>

</body>
</html>