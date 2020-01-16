<html>
	<head>
		<link href="sources/memory.css" rel="stylesheet">
		<title>Memory</title>
		<link rel="icon" href="images/avatar.png">
	</head>


	<body class="accueil">
<?php
include("sources/config.php");
if((isset($_POST['play']))&&(!isset($_SESSION['play'])))
{
header('location: index.php');
}
if(!isset($_SESSION['login']))
{
	header('Location: connexion.php');
}

if(isset($_POST['deco']))
    {
    session_destroy();
    header('Location: index.php');
	}
include("header.php")
?>

<div <?php if(!isset($_SESSION['termine']))
{ 
?>
class="play"<?php } ?>>
<form method="post" action="index.php">
<?php
if(!isset($_SESSION['termine']))
{
?>
	<select required name="test">
		<option value="3">Très Facile</option>
		<option value="6">Facile</option>
		<option value="9">Moyen</option>
		<option value="12">Difficile</option>
	</select>
<?php
}
if(!isset($_SESSION['play']))
{	
if(!isset($_SESSION['termine']))
{
?>
	<input class="button" type="submit" name="play" value="Jouer">
<?php
}
}
?>
</form>


<form method="post" action="index.php">
	<input class="button" type="submit" name="replay" <?php if(!isset($_SESSION['termine'])){	
	?>value="Quitter"
	<?php
	}
	else
	{
	?>
    value="Rejouer"
	<?php
	}
	?>
	>
</form>
</div>
<?php
if(!isset($_SESSION['termine']))
{ 
$base= mysqli_connect("localhost", "root", "", "memory");
mysqli_set_charset($base, "utf8");
?>
	<?php
	$requete='SELECT login, MIN(temps) FROM utilisateurs INNER JOIN score INNER JOIN niveau WHERE id_utilisateur=utilisateurs.id and id_niveau="3"';
	$result=mysqli_query($base, $requete);
	$resultat=mysqli_fetch_array($result);

	$requete2='SELECT login, MIN(temps) FROM utilisateurs INNER JOIN score INNER JOIN niveau WHERE id_utilisateur=utilisateurs.id and id_niveau="6"';
	$result2=mysqli_query($base, $requete2);
	$resultat2=mysqli_fetch_array($result2);

	$requete3='SELECT login, MIN(temps) FROM utilisateurs INNER JOIN score INNER JOIN niveau WHERE id_utilisateur=utilisateurs.id and id_niveau="9"';
	$result3=mysqli_query($base, $requete3);
	$resultat3=mysqli_fetch_array($result3);

	$requete4='SELECT login, MIN(temps) FROM utilisateurs INNER JOIN score INNER JOIN niveau WHERE id_utilisateur=utilisateurs.id and id_niveau="12"';
	$result4=mysqli_query($base, $requete4);
	$resultat4=mysqli_fetch_array($result4);
?>
	

	<article id="jeu_global">
	<article id="wof">
	<div id="scoreboard">
		<div id="score_titre">Meilleurs Scores</div>
	<table>	
	<tbody>
	<tr>
		<th>Difficulté</th>
		<th>Temps</th>
		<th>Joueur</th>
	</tr>
	<tr>
		<th>
		Très Facile
		</th>
		<td> <?php echo $resultat['MIN(temps)'];?> </td>
		<td> <?php echo $resultat['login']; ?></td>
	</tr>
	<tr>
		<th>
		Facile
		</th>
		<td> <?php echo $resultat2['MIN(temps)'];?> </td>
		<td> <?php echo $resultat2['login']; ?></td>
	</tr>
	<tr>
		<th>
		Moyen
		</th>
		<td> <?php echo $resultat3['MIN(temps)'];?> </td>
		<td> <?php echo $resultat3['login']; ?></td>
	</tr>
	<tr>
		<th>
		Difficile
		</th>
		<td> <?php echo $resultat4['MIN(temps)'];?> </td>
		<td> <?php echo $resultat4['login'];?></td>

	</tr>
	</table>
</article><?php }


if(isset($_SESSION['termine']))
{
	$base= mysqli_connect("localhost", "root", "", "memory");
	mysqli_set_charset($base, "utf8");
	
	$T=substr($_SESSION['fin'] - $_SESSION['debut'], 0, 5); ;
	$niveau=$_SESSION['test'];
	
	$login=$_SESSION['login'];
	$requete5="SELECT id FROM utilisateurs WHERE login = '$login'";
	$result5=mysqli_query($base, $requete5);
	$resultat5=mysqli_fetch_array($result5);

	$id=$resultat5['id'];

	$requete7="INSERT INTO score (temps, id_utilisateur, id_niveau) VALUES('".$T."', '".$id."','".$niveau."')";
	mysqli_query($base, $requete7);
	
	
	$requete6="SELECT difficulte, temps, login FROM niveau, score, utilisateurs WHERE id_utilisateur = utilisateurs.id and id_niveau=niveau.id";
	$result6=mysqli_query($base, $requete6);
	
	mysqli_close($base);
	
	
	
	?>
	
	<div id="messagefin">
		<img src="https://fontmeme.com/permalink/200114/df7e82d57b87f3f06943b362167a751e.png" alt="police-pokemon" border="0"></a>
	</div>
	
	<div class="center"><?php echo "En ". (substr($_SESSION['fin'] - $_SESSION['debut'], 0, 5)). " secondes !";?></div>
	<div class="center"><img id="victoire" src="gif/victoire.gif"></div>
	
	<?php
	unset($_SESSION['cartesfaces']);
	unset($_SESSION['play']);
	unset($_SESSION['test']);
	unset($_SESSION['difficultée']);
	unset($_SESSION['jeuencours']);
	unset($_SESSION['cartesdos']);
	unset($_SESSION['jeux']);
	unset($_SESSION['termine']);
	
}
if(isset($_POST['replay']))
{
	unset($_SESSION['cartesfaces']);
	unset($_SESSION['play']);
	unset($_SESSION['test']);
	unset($_SESSION['difficultée']);
	unset($_SESSION['jeuencours']);
	unset($_SESSION['cartesdos']);
	unset($_SESSION['jeux']);
	unset($_SESSION['termine']);
	header('Location: index.php');
}
if(isset($_POST['cartes']))
{
	$_SESSION['cartesfaces']=SUBSTR($_POST['cartes'],0,5);
}
if((isset($_POST['play']))||(isset($_SESSION['play'])))
{
if(!isset($_SESSION['test'])){	
$_SESSION['test']=$_POST['test'];
switch ($_SESSION['test']){
	case 3:
	$_SESSION['difficultée']="Très Facile";
	break;
	
	case 6:
	$_SESSION['difficultée']="Facile";
	break;
	
	case 9:
	$_SESSION['difficultée']="Moyen";
	break;
	
	case 12:
	$_SESSION['difficultée']="Difficile";
	break;
}
}
	$_SESSION['play']=true;
	$dir = opendir("cartes/");
	
	$dos='../Back.png';
	$array = [];
while($file = readdir($dir)){
	 
	if( $file != '.' && $file != '..' && preg_match('#\.(jpe?g)$#i', $file))
	{
		array_push($array, $file); 	
	}		
	
	
}
closedir($dir);
if(!isset($_SESSION['jeuencours']))
{
$p=0;
$_SESSION['cartesdos']=[];
if(!isset($_SESSION['jeuencours']))
	{
	while($p != $_SESSION['test']*2)
	{
	array_push($_SESSION['cartesdos'], $dos);
	$p=$p+1;	
	}
	}		
}		
$array2=array();
echo '<br>';
$nb_a_tirer =  $_SESSION['test'];
while($nb_a_tirer != 0)
{
	
	$nombre= mt_rand(0, count($array)-1);
if( !in_array($array[$nombre], $array2))
	{
		$array2[]=$array[$nombre];
		$nb_a_tirer--;
	}
}
$doubles=$array2;
$paires=array_merge($array2, $doubles);
if(isset($_POST['play']))
{
	shuffle($paires);
		foreach ($paires as $cartes){
		
	}
	$_SESSION['tab']=$paires;
	$_SESSION['debut']=microtime(true);
}
?>

<article 
<?php if($_SESSION['test']==12)
{?>
 id="jeu2" 
 <?php
}
else
{
?>
id="jeu"
<?php
}?>
>

	<form method="post" action="index.php">
<?php
$i=($_SESSION['test']*2);
if(!isset($_POST['cartes']))
{	
	for ($num = 0; $num < $i; $num++)
	{ 	
		?><input id="cartes" style="background-image: url(cartes/<?php echo $_SESSION['cartesdos'][$num]; ?>)"  name="cartes" type="submit" class="<?php echo $num;?>"  value="<?php  echo $_SESSION['tab'][$num]; echo $num; ?>"><?php 	
	}
}
else
{
	
	for ($num = 0; $num < $i; $num++)
	{ 		
		if($num == SUBSTR(($_POST['cartes']),5))
		{		
			$replace=array(SUBSTR(($_POST['cartes']),5) => SUBSTR($_POST['cartes'],0,5));
			$_SESSION['cartesdos']=array_replace($_SESSION['cartesdos'], $replace); 
			$_SESSION['jeuencours']="ok";
			
			
		}	
	}
	
	for($k=0; $k < $i; $k++)
	{
	?><input id="cartes" style="background-image: url(cartes/<?php echo $_SESSION['cartesdos'][$k]; ?>)"  name="cartes" type="submit" class="<?php echo $k;?>"  value="<?php  echo $_SESSION['tab'][$k]; echo $k; ?>"><?php		
	}
}
$p=0;
$n=0;
if(!isset($_SESSION['jeux']))
{
	$_SESSION['jeux']=$_SESSION['cartesdos'];;
	
}
if(isset($_POST['cartes']))
{
	for($p=0; $p <$i; $p++)
	{
		if($_SESSION['cartesdos'][$p]=="../Back.png")
		{
			$n=$n+1;	
		}
	}
if($n % 2){
}
else
{
	$tab=(array_count_values($_SESSION['cartesdos']));
	if(($tab[SUBSTR($_POST['cartes'],0,5)])==2)	
	{	
		$replace=array(SUBSTR(($_POST['cartes']),5) => SUBSTR($_POST['cartes'],0,5));
		$_SESSION['jeux']=array_replace($_SESSION['jeux'], $replace); 	
		$_SESSION['jeux']=$_SESSION['cartesdos'];
		?><meta http-equiv="refresh" content="0.3;URL=index.php"><?php
		
	}
	else
	{
		if(!isset($_SESSION['jeux']))
		{
			unset($_SESSION['jeuencours']);
			?><meta http-equiv="refresh" content="0.3;URL=index.php"><?php
		}
		else
		{
			$_SESSION['cartesdos']=$_SESSION['jeux'];
			?><meta http-equiv="refresh" content="0.3;URL=index.php"><?php
			
		}
	}
}
}
$k=0;
for($j=0; $j < $i; $j++)
{
if($_SESSION['cartesdos'][$j]=="../Back.png")
{
$k=$k+1;
}
	
}
if($k==0)
{
$_SESSION['fin']= microtime(true);
unset($_SESSION['play']);
$_SESSION['termine']="Vous avez gagné !";
?><meta http-equiv="refresh" content="0;URL=index.php"><?php	
}
?>

	</form>
</article>


<?php
}
?>

  </body>
</html>