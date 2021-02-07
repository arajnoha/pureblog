<?php
session_start();

if (isset($_SESSION["in"]) && $_SESSION["in"] === 1) {
    include("data.php");

    if (isset($_POST["sitename"]) && isset($_POST["sitedescription"]) && isset($_POST["sitepassword"])) {
        $file = fopen("data.php","w");
        $newvalues = '<?php $siteName = "'.$_POST["sitename"].'";$siteDescription = "'.$_POST["sitedescription"].'"; $sitePassword = "'.$_POST["sitepassword"].'";  $siteBlogPageSlug = "'.$_POST["siteblogpageslug"].'"; ?>';
		fwrite($file, $newvalues);
        fclose($file);

        // rename the blog folder if needed
        if ($siteBlogPageSlug !== $_POST["siteblogpageslug"]) {
            rename("../".$siteBlogPageSlug,"../".$_POST["siteblogpageslug"]);
        }

        header("Location: ../admin/");
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
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" class="block">
        <label for="sitename">Blog title</label>
        <input type="text" id="sitename" name="sitename" class="regular full" value="<?=$siteName;?>" spellcheck="false">
        <label for="sitedescription">Blog description</label>
        <textarea type="text" id="sitedescription" name="sitedescription" class="regular" spellcheck="false"><?=$siteDescription;?></textarea>
        <label for="siteblogpageslug">URL name of the main blog page</label>
        <input type="text" id="siteblogpageslug" name="siteblogpageslug" class="regular" value="<?=$siteBlogPageSlug;?>">
        <label for="sitepassword">Password</label>
        <input type="password" id="sitepassword" name="sitepassword" class="regular" value="<?=$sitePassword;?>">
        <input type="submit" name="submit" value="Save">
        </form>
        </main>
    </body>
</html>
<?php } else {
    header("Location: ../admin/");
}

