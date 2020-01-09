<html>
	<head>
		<link href="sources/memory.css" rel="stylesheet">
		<title>Memory</title>
	</head>





	<body>
<?php

session_start();

?>	

<form method="post" action="index.php">
	<input type="submit" name="play" value="Jouer">
	<input type="submit" name="replay" value="Quitter">
</form>

 
<?php
	
if(isset($_POST['cartes']))
{
	
	
	$_SESSION['cartesfaces']=SUBSTR($_POST['cartes'],0,5);
	
	
	
	
}else
{
$face='../Back.png';
$_SESSION['cartes']=$face;	
}
if(isset($_POST['replay']))
{
	unset($_SESSION['play']);
}

if(isset($_POST['play'])||(isset($_SESSION['play'])))
{	
	$_SESSION['play']=true;
	$dir = opendir("cartes/");
	
	$array = [];
	$i =0;

while($file = readdir($dir)) {
	
	if( $file != '.' && $file != '..' && preg_match('#\.(jpe?g)$#i', $file))
	{
	array_push($array, $file); 
	$i=$i+2;
	}
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
	
		?><input id="cartes" style="background-image: url(cartes/<?php echo $_SESSION['cartes']; ?>)"  name="cartes" type="submit" class="<?php echo $num;?>"  value="<?php  echo $_SESSION['tab'][$num]; echo $num; ?>"><?php 	
}
}
else
{
	for ($num = 0; $num < $i; $num++)
{ 
	
		if($num ==SUBSTR(($_POST['cartes']),5))
		{
			
		?><input id="cartes" style="background-image: url(cartes/<?php echo SUBSTR($_POST['cartes'],0,5); ?>)"  name="cartes" type="submit" class="<?php echo SUBSTR(($_POST['cartes']),5);?>"  value="<?php  echo $_SESSION['tab'][$num]; echo $num; ?>"><?php
		}
		else
		{
		?><input id="cartes" style="background-image: url(cartes/<?php echo $_SESSION['cartes']; ?>)"  name="cartes" type="submit" class="<?php echo $num;?>"  value="<?php  echo $_SESSION['tab'][$num]; echo $num; ?>"><?php 	
		}
}
	
	
}
?>

	</form>
</article>

<?php
}
?>

  </body>
</html>