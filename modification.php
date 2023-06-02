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
<div class="col-lg-8">
<hr>
<div class="panel panel-success">
  <div class="panel-heading">MODIFICATION</div>
  <div class="panel-body">
    <fieldset>
  <legend><b>Modifier vos informations</b></legend>

      <form action="" method="post">
    <table class="login_table">
    <tr>
    <td>Username<span>*</span> :</td>
    <td><input type="text" name="user" id="user" value=<?php echo $_SESSION['user'] ?> onclick="this.value='' " required></td>
	</tr>
	<tr>		
    <td>Adresse mail<span>*</span> :</td>
    <td><input type="email" name="email_lecteur" id="email_lecteur" value=<?php echo $_SESSION['email'] ?> onclick="this.value='' " required></td>
    </tr>
    <tr>
    <td>Pasword<span>*</span></td>
    <td><input type="password" name="psw" id="password" value=<?php echo $_SESSION['psw'] ?> onclick="this.value='' " required></td>
    </tr>
    <tr>
    <td>Nom<span>*</span></td>
    <td><input type="text" name="nom_lecteur" id="nom_lecteur" value=<?php echo $_SESSION['nom_lecteur'] ?> onclick="this.value='' " required></td>
    </tr>
    <tr>
    <td>Nom<span>*</span></td>
    <td><input type="text" name="prenom_lecteur" id="prenom_lecteur" value=<?php echo $_SESSION['prenom_lecteur'] ?> onclick="this.value='' " required></td>
    </tr>
    <tr>
    <td>Date-naissance<span>*</span></td>
    <td><input type="date" name="date_naissance" id="date_naissance" value=<?php echo $_SESSION['date_naissance'] ?> onclick="this.value='' " required></td>
    </tr>
    <tr>
    <td>adresse <span>*</span></td>
    <td><input type="text" name="addresse" id="addresse" value=<?php echo $_SESSION['adresse'] ?> onclick="this.value='' " required></td>
    </tr>
    <tr>
    <td></td>
    <td><input type="submit" value="modifier"></td>
    </tr>
    </table>
  </form>

</fieldset>
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

if(!empty($_SESSION['id_lecteur']) AND !empty($_POST['user']) AND !empty($_POST['psw']) AND !empty($_POST['nom_lecteur']) AND !empty($_POST['date_naissance']) AND !empty($_POST['addresse'])){

  $lecteur=new lecteur();
 $lecteur->modification($_SESSION['id_lecteur'], $_POST['nom_lecteur'], $_POST['prenom_lecteur'], $_POST['user'], $_POST['email_lecteur'], $_POST['date_naissance'], $_POST['addresse'], $_POST['psw']);
    $_SESSION['nom_lecteur']=$_POST['nom_lecteur'];
    $_SESSION['email_lecteur']=$_POST['email_lecteur'];
    $_SESSION['date_naissance']=$_POST['date_naissance'];
    $_SESSION['adresse']=$_POST['addresse'];
    $_SESSION['psw']=$_POST['psw'];

}

?>