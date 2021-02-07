<?php
session_start();
include("data.php");

if (isset($_SESSION["in"]) && $_SESSION["in"] === 1) {
	header("Location: ../admin/");
}

$msg = '';

if (isset($_POST['login'])) {
	if ($_POST['login'] === $sitePassword) {
		$_SESSION["in"] = 1;
		header("Location: ../admin/");
	} else {
		$msg = "Bad password.";
	}	
}
?>
<!doctype html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <title><?=$siteName;?></title>
        <link rel="stylesheet" type="text/css" href="pretty/neon.css">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="<?=$siteDescription;?>">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet"> 
	<link rel="icon" type="image/png" href="pretty/i/favicon.png">
    </head>
    <body>
        <main>
        <header>
        <h2><a href="../"><?=$siteName;?></a></h2>
        <p><?=$siteDescription;?></p>
        </header>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
	<input type="password" id="login" name="login" class="regular" placeholder="Fill in your password" autofocus><input type="submit" name="submit" value=">">
	<p><?=$msg;?></p>
        </form>
        </main>
    </body>
</html>

