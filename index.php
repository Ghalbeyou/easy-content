<?php
require_once 'config.php';
if ($config["setup"] == false) {
    header("Location: setup.php");
}
echo "<title>".$config["title"]."</title>";
// echo file_get_contents("public/header.html");
$posts = file_get_contents("posts.json");
$posts = json_decode($posts, true);
echo '<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Document</title> -->
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Welcome to ' . $config["title"] . '</h1>
            </div>
            <div class="col-md-12">
                <!-- show postes !-->
                <div class="row" id="posts">
                    <div class="col-md-12">
                        <h2>Posts</h2>
                        ' . showPosts($posts) . '
                    </div>
        </div>
    <script src="/public/js/jquery.min.js"></script>
    <script src="/public/js/bootstrap.js"></script>
</body>
</html>';
function showPosts($posts)
{
    $html = "";
    foreach ($posts as $post) {
        $html .= '<div class="row">
            <div class="col-md-12">
                <a href="/read.php?id=' . $post["id"] . '"><h3>' . $post["title"] . '</h3></a>
                <p>You can see this post by clicking the read more button!</p>
                <a href="/read.php?id=' . $post["id"] . '" class="btn btn-primary">Read More</a>
                </div>
        </div>';
    }
    return $html;
}
?>