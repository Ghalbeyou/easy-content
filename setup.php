<?php
require 'config.php';
if ($config["setup"] == true) {
    header("Location: index.php");
    die();
}
$step = $_GET["s"];
if (!isset($step)) {
    header("Location: setup.php?s=1");
    die();
}
if ($step == 1){
    echo file_get_contents('public/setup.step1.page.html');
    die();
}
if ($step == 2){
    if (!isset($_GET['se_name']) || !isset($_GET['se_url']) || !isset($_GET['se_email']) || !isset($_GET['se_password']) || !isset($_GET['se_password_confirm']) || !isset($_GET['se_username'])) {
        header("Location: setup.php?s=1");
        die();
    }
    if ($_GET['se_password'] != $_GET['se_password_confirm']) {
        echo "<div class='alert alert-danger'>Passwords do not match!</div>";
        echo file_get_contents('public/setup.step1.page.html');        
        die();
    }
    $config["title"] = $_GET['se_name'];
    $config["url"] = $_GET['se_url'];
    $config["email"] = $_GET['se_email'];
    $config["password"] = $_GET['se_password'];
    $config["username"] = $_GET['se_username'];
    // $config["language"] = $_GET['se_language'];
    $config["setup"] = true;
    $config2 = json_encode($config);
    $users = file_get_contents('users.json');
    $users = json_decode($users, true);
    $users[] = array(
        "username" => $config["username"],
        "password" => md5($config["password"]),
        "email" => $config["email"],
        "admin" => true
    );
    $users2 = json_encode($users);
    file_put_contents('users.json', $users2);

    file_put_contents('config.json', $config2);
    echo file_get_contents('public/setup.step2.page.html');
    die();
}
if ($step == 3){
    echo file_get_contents('public/setup.step3.page.html');
    die();

}
?>