<html>
	<head>
		<link rel="stylesheet" href="memory.css">
		<title>Memory</title>
		<link rel="icon" href="images/avatar.png">
	</head>

<body class="profil">
<?php
include("sources/config.php");
include("header.php");

if(!isset($_SESSION['login']))
{
	header('Location: connexion.php');
}

if(isset($_SESSION['login']))
{

	
$login=$_SESSION['login'];
$base= mysqli_connect("localhost", "root", "", "memory");
mysqli_set_charset($base, "utf8");

$requete='SELECT  MIN(temps) FROM niveau, score, utilisateurs WHERE id_utilisateur=utilisateurs.id and id_niveau="3" and utilisateurs.login="'.$login.'"';
$result=mysqli_query($base, $requete);
$resultat=mysqli_fetch_array($result);

$requete2='SELECT MIN(temps) FROM niveau, score, utilisateurs WHERE id_utilisateur=utilisateurs.id and id_niveau="6" and utilisateurs.login="'.$login.'"';
$result2=mysqli_query($base, $requete2);
$resultat2=mysqli_fetch_array($result2);

$requete3='SELECT  MIN(temps) FROM niveau, score, utilisateurs WHERE id_utilisateur=utilisateurs.id and id_niveau="9" and utilisateurs.login="'.$login.'"';
$result3=mysqli_query($base, $requete3);
$resultat3=mysqli_fetch_array($result3);

$requete4='SELECT  MIN(temps) FROM niveau, score, utilisateurs WHERE id_utilisateur=utilisateurs.id and id_niveau="12" and utilisateurs.login="'.$login.'"';
$result4=mysqli_query($base, $requete4);
$resultat4=mysqli_fetch_array($result4);


?>
<div class="pokemon"><img src="gif/poke.gif" width="30%"></div>



<?php
if(!isset($_POST['modif']))

?>
<article class="scoreperso">
	<div>
	
	<table>
	<thead>
        <tr>
            <th colspan="2">Meilleurs scores</th>
        </tr>
    </thead>
	
	<tbody>
	<tr>
		<th>Difficulté</th>
		<th>Scores (en s)</th>
	</tr>
	<tr>
		<th>
		Très Facile
		</th>
		<td> <?php echo $resultat['MIN(temps)'];?> </td>
	</tr>
	<tr>
		<th>
		Facile
		</th>
		<td> <?php echo $resultat2['MIN(temps)'];?> </td>
	</tr>
	<tr>
		<th>
		Moyen
		</th>
		<td> <?php echo $resultat3['MIN(temps)'];?> </td>
	</tr>
	<tr>
		<th>
		Difficile
		</th>
		<td> <?php echo $resultat4['MIN(temps)'];?> </td>
	</tr>
	
	</tbody>
</table>
	</diV>
	
		<div><img class="carapuce" src="gif/carapuce.gif" width="80%"></div>

	<div>

<?php

$requete5="SELECT login, difficulte, temps FROM niveau, score, utilisateurs WHERE id_utilisateur=utilisateurs.id and id_niveau=niveau.id and login='$login' ORDER BY score.id DESC LIMIT 5";
$result5=mysqli_query($base, $requete5);

?>

<table>
    <thead>
        <tr>
            <th colspan="2">Mes 5 dernières parties</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>Difficulté</th>
            <th>Scores (en s)</th>
        </tr>
		
		<?php while($resultat5=mysqli_fetch_array($result5))
		{
		?>
		<tr>
			<td><?php echo $resultat5['difficulte'];?></td>
			<td><?php echo $resultat5['temps'];?></td>
		</tr>
		<?php
		}
		?>
		
    </tbody>
</table>
</div>
</article>

<?php
}
?>

</body>
</html>






