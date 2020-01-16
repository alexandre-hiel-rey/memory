<?php
session_start();
    $output= NULL;
    $_SESSION['db'] = mysqli_connect('localhost','root','','memory');

    function register($login, $pass)
    {
        $db = $_SESSION['db'];
        $login = $db->real_escape_string($login);
        $pass =  $db->real_escape_string($pass);
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $insert = $db->query("INSERT INTO utilisateurs (login , password) VAlUES ('$login','$pass')");
        header("Location: connexion.php");
    }


    function login($login, $pass)
    {
        $db = $_SESSION['db'];
        $login = $db->real_escape_string($_POST["login"]);
        $pass =  $db->real_escape_string($_POST["pass"]);
        $query = $db->query("SELECT login FROM utilisateurs where login = '$login'");
        if($query->num_rows == 0)
        {
            $output = "Pseudo Inconnue";
        }
        else
        {
            $checkpass = "SELECT password FROM utilisateurs WHERE login = '$login'";
            $passquery = $db->query($checkpass);
            $cryptedpass = mysqli_fetch_all($passquery);
            $cryptedpass = $cryptedpass[0][0];
            $passencrypt = password_verify($pass, $cryptedpass);

            if($passencrypt == TRUE)
            {
                $login_infos = "SELECT id, login from utilisateurs where login = '$login'";
                $user_query = mysqli_query($db, $login_infos);
                $result = mysqli_fetch_all($user_query);
                $_SESSION['id'] = $result[0][0];
                $_SESSION['login'] = $result[0][1];
                header('Location: index.php');
            }
            else
            {
                $output = "Pseudo ou Mot de passe invalide";
            }
        }
        
    }

?>