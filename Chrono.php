<?php
if (!isset($_POST["start"])&& !isset($_POST["end"])){ ?>
    <form action="test.php" method="post">
    <input type="hidden" name="start" value="debut" /><br />
    <input type="submit" value="START" />
    </form> 
    <?php
}
if (isset($_POST["start"])){
    $debut = microtime(true); ?>
    <form action="test.php" method="post">
    <input type="hidden" name="end" value=<?php echo $debut ?> /><br />
    <input type="submit" value="END" />
    </form> <?php
}
 
if (isset($_POST["end"])){
    $debut = $_POST["end"];
    $fin = microtime(true);
    echo (substr($fin - $debut, 0,5)) . "seconde";
}
?>
