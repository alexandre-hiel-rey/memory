<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="sources/memory.css" rel="stylesheet">
</head>
<header>
    <div id="titre_header"><a href="index.php"><h1>Pokémemory</h1></a></div>
    <div id="profil_header">
        <div id="info_profil">
            <div id="pseudo_profil"><a href="profil.php"><?php echo $_SESSION["login"]; ?></a></div>
            <div id="profil_button"><form method="post" action="index.php" name="deco_b">
                <input type="submit" name="deco" value="Déconnection">
            </div>
        </div>
        <div id="avatar_profil">
            <a href="profil.php"><img src="images/avatar.png"></a>
        </div>
    </div>
</header>
</html>

