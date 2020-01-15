<?php include('config.php'); ?>
<?php
    $output= NULL;
    if(isset($_SESSION['login']))
    {
        header('Location: index.php');
    }

    if(isset($_POST["submit"]))
    {
        $db = $_SESSION['db'];
        $login = $_POST["login"];
        $pass =  $_POST["pass"];
        $pass2 =  $db->real_escape_string($_POST["pass2"]);
        $query = $db->query("SELECT * FROM utilisateurs Where login = '$login'");

        if($query->num_rows != 0)
        {
            $output = "Ce pseudo est déjà utilisé.";
        }
        elseif($pass2 != $pass)
        {
            $output = "Vos mot de passes ne correspondent pas.";
        }
        elseif(strlen($pass)<= 3)
        {
            $output = "Votre mot de passe doit faire plus de 3 caractères.";
        }
        else
        {
            $login = $_POST['login'];
            $pass = $_POST['pass'];
            register($login, $pass);
        }
    }
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Inscription</title>
        <link rel="stylesheet" href="sources/memory.css">
    </head>
    <body id="co"> 
        <div class="box2">
                <h4>Inscription</h4>
                <fieldset>
                <legend>Identifiants</legend>
                <form method="POST" action="inscription.php">
                <div class="inputbox2">
                        <input type="text" name="login" required>
                        <label>Pseudo</label>
                    </div>
                    <div class="inputbox2">
                        <input type="password" name="pass" required>
                        <label>Mot de passe</label>
                    </div>
                    <div class="inputbox2">
                        <input type="password" name="pass2" required>
                        <label>Confirmer mot de passe</label>
                    </div>
                </fieldset>
                <div class="check">
                    <input type="checkbox" id="" name="" required>
                    <a href=""><label>Conditions générales</label></a>
                </div>
                <?php echo '<div style="color:white; text-align:center">'.$output.'</div>'?><br>
                <div class="bouton">
                <input type="submit" name="submit" value="S'inscrire">
                </div>
                <div class="link">
                <h3><a href="connexion.php">Déja inscrit ?</a></h3>
                </div>
                </form>
        </div>
    </body>
</html>