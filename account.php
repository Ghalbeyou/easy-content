<?php
require 'config.php';
if($config['setup'] == false){
    header('Location: setup.php');
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if ($_POST['action'] == 'login'){
        $users = file_get_contents('users.json');
        $users = json_decode($users, true);
        foreach ($users as $user) {
            if ($user['username'] == $_POST['username'] && $user['password'] == md5($_POST['password'])) {
                $_SESSION['user'] = $user['username'];
                // header("Location: account.php");
                // die();
                if ($user['admin'] == true){
                    echo file_get_contents("public/account.admin.page.html");
                    die();
                }
                else{
                    echo file_get_contents("public/account.page.html");
                    die();
                }
            }
        }
        echo '<div class="alert alert-danger">Wrong username or password!</div>';
        // echo file_get_contents('public/access.page.html');
    }
}
if(!isset($_SESSION['user'])){
    echo "<title>".$config["title"]." - Login</title>";
    echo file_get_contents('public/access.page.html');
    die();
}
if($_SESSION['user'] != null){
    echo "<title>".$config["title"]." - Account</title>";
    echo file_get_contents('public/account.page.html');
    die();
}
if($_GET['logout'] == 'true'){
    session_destroy();
    header("Location: index.php");
    die();
}

?>