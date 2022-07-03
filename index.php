<?php
include_once './load_config.php';
// check if the global variable $setup is true or false
if ($GLOBALS['setup'] == false){
    include './public/setup.html';
} else {
    // this means that the site is loaded
    include './public/home.html';
}
if ($_GET['pg'] == 'read_post'){
    include './public/read_post.html?post=' . $_GET['id'];
}
if ($_GET['pg'] == 'send_post'){
    include './public/send_post.html'
}
?>