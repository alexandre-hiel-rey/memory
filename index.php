<html>
	<head>
		<link href="sources/memory.css" rel="stylesheet">
		<title>Memory</title>
	</head>





	<body oncontextmenu="return false" onkeydown="return false;">
<?php

session_start();

?>	
<div>
<form method="post" action="index.php">
	
	<input type="submit" name="play" value="Jouer">
</form>

<form method="post" action="index.php">
	<input type="submit" name="replay" value="Rejouer">
</form>
</div>
 
<?php

if(isset($_SESSION['termine']))
{
	?>
	<div id="messagefin">
		<div><?php echo $_SESSION['termine'];?></div>
	</div>
	<center><img id="victoire" src="gif/victoire.gif"></center>
	<?php
	unset($_SESSION['termine']);
}
if(isset($_POST['replay']))
{
	session_destroy();
}

if(isset($_POST['cartes']))
{
	$_SESSION['cartesfaces']=SUBSTR($_POST['cartes'],0,5);
}

if(isset($_POST['play'])||(isset($_SESSION['play'])))
{	
	
	$_SESSION['play']=true;
	$dir = opendir("cartes/");
	
	$retourne=[];
	$dos='../Back.png';

	
	$array = [];
	$i =0;
	// $p=0;
	
	// $k=$_POST['paires'];
	
	

while($file = readdir($dir)) {
	
	if( $file != '.' && $file != '..' && preg_match('#\.(jpe?g)$#i', $file))
	{
	array_push($array, $file); 
	
	if(!isset($_SESSION['jeuencours']))
	{
	array_push($retourne, $dos);
	}
	
	$i=$i+2;
	}
	// $p=$p+1;
}
if(!isset($_SESSION['jeuencours']))
{
	$retroune2=$retourne;
	$_SESSION['cartesdos']=array_merge($retourne, $retroune2);
}


$doubles=$array;
closedir($dir);
$paires=array_merge($array, $doubles);



if(isset($_POST['play']))
{
	shuffle($paires);
		foreach ($paires as $cartes){
		
	}
	$_SESSION['tab']=$paires;
}
?>

<article id="jeu">
	<form method="post" action="index.php">
<?php



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
		?><meta http-equiv="refresh" content="1;URL=index.php"><?php
		
	}
	else
	{
		if(!isset($_SESSION['jeux']))
		{
			unset($_SESSION['jeuencours']);
			?><meta http-equiv="refresh" content="1;URL=index.php"><?php
		}
		else
		{
			$_SESSION['cartesdos']=$_SESSION['jeux'];
			?><meta http-equiv="refresh" content="1;URL=index.php"><?php
			
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