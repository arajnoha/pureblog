<?php
session_start();
include("../admin/data.php");

function makeArticleDOM($title,$perex,$siteName,$content) {

$date = date("Y-m-d");
$DOM = <<<LOL
<?php include("../../admin/data.php"); ?>
<!doctype html>
<html lang="cs">
<head>
<meta charset="utf-8">
<title>$title</title>
<link rel="stylesheet" type="text/css" href="../../admin/pretty/neon.css">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="$perex">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
<link rel="icon" type="image/png" href="../../admin/pretty/i/favicon.png">
</head>
<body>
<main>
<header class="blogpost">
<h2><a href="../../">$siteName</a></h2>
</header>
<section><h1>$title</h1><span>$date</span><div>$content</div></section>
</main>
</body>
</html>
LOL;
return $DOM;
}

function makePageDOM($title,$perex,$siteDescription,$siteName,$content,$slug) {
    

$DOM = <<<LOL
<!doctype html>
<html lang="cs">
<head>
<meta charset="utf-8">
<title>$title</title>
<link rel="stylesheet" type="text/css" href="../admin/pretty/neon.css">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="description" content="$siteDescription">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet"> 
<link rel="icon" type="image/png" href="../admin/pretty/i/favicon.png">
</head>
<body>
<main>
<header>
<h2><a href="../">$siteName</a></h2>
<p>$siteDescription</p>
</header>
<?php include("../admin/bones/nav.php"); ?>
<?php include("../admin/bones/pageadminnav.php"); ?>
<section><div>$content</div></section>
<footer>
<a href="../admin/login.php" class="graylink">Log in</a>  |  <a href="https://github.com/arajnoha/pureblog" class="graylink">pureblog project</a>
</footer>
</main>
<script src="../admin/pretty/do.js"></script>
</body>
</html>
LOL;
return $DOM;

}

?>