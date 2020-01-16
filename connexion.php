<?php include('sources/config.php');
$output= NULL;

if(isset($_SESSION['login']))
{
	header('Location: connexion.php');
}

if(isset($_POST['submit']))
{
    $mysqli = mysqli_connect("localhost", "root", "", "memory");
    $login = $mysqli->real_escape_string($_POST["login"]);
    $pass =  $mysqli->real_escape_string($_POST["pass"]);
   login($login, $pass);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Connexion</title>
        <link rel="stylesheet" href="sources/memory.css">
        <link rel="icon" href="images/avatar.png">
    </head>

    <body id="co">
        <div class="box">
            <h2>Connexion</h2>
            <form method="POST">
                <div class="inputbox">
                    <input type="text" name="login" required>
                    <label>Pseudo</label>
                </div>
                <div class="inputbox">
                        <input type="password" name="pass" required>
                        <label>Mot de passe</label>
                </div>
                <div class="error_and_button">
                <?php echo '<div style="color:white; text-align:center">'.$output.'</div>'?><br>
                <input type="submit" name="submit" value="Valider">
                </div>
                <div class="link">
                    <h3><a href="inscription.php">Inscription</a><h3>
                </div>
            </form>
        </div>
    </body>
</html>