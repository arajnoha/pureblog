<?php
session_start();

function getTitle($string) {
	$pattern = "/<h1>(.*?)<\/h1>/";
	preg_match_all($pattern, $string, $matches);
	return ($matches[1]);
}

function stringifyTitle($str, $delimiter = '-') {
	$slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    return $slug;
}

if (isset($_SESSION["in"]) && $_SESSION["in"] === 1) { 

	include("data.php");
	include("bones/function.php");
	

	if (isset($_POST["writearea"]) && $_POST["writearea"] !== "") {

		// initialise the default blog folder
		if (!file_exists('../'.$siteBlogPageSlug.'/')) {
			mkdir('../'.$siteBlogPageSlug.'/', 0777, true);
		}		

		include("parsedown/Parsedown.php");
		$Parsedown = new Parsedown();

		// parse all content to html
		$content = $Parsedown->text($_POST["writearea"]);
		
        // get title and slug before cutting it from the content
		$title = getTitle($content);
		$slug = stringifyTitle(implode($title));

        // crop the title and make perex
        $content = substr($content, strpos($content, '</h1>') + 5);
		$perex = mb_strimwidth(strip_tags($content), 0, 180, "...");


		mkdir("../".$siteBlogPageSlug."/".$slug);

		// create metafile
		$file = fopen("../".$siteBlogPageSlug."/".$slug."/meta.json","w");
		$fileArray = array('name' => implode($title), 'slug' => $slug, 'date' => date("Y-m-d"), 'perex' => $perex);
		fwrite($file, json_encode($fileArray));
		fclose($file);

		// create markdown backup for future edits
		$file = fopen("../".$siteBlogPageSlug."/".$slug."/article.md","w");
		fwrite($file, $_POST["writearea"]);
		fclose($file);

		// create actual permalink file
		$file = fopen("../".$siteBlogPageSlug."/".$slug."/index.php","w");

		// pre-created html filled with new content
		$fileString = makeArticleDOM(implode($title),$perex,$siteName,$content);

		fwrite($file, $fileString);
		fclose($file);

		header("Location: index.php");

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
		<form action="write.php" method="post" class="write">
		<nav class="clean">
			<a class="graylink" href="../admin/">Discard</a>
			<input type="submit" value="Publish"> 
		</nav>
		<textarea name="writearea" spellcheck="false" placeholder="# Start with a title" autofocus></textarea>		
		</form>
		</main>
	    </body>
	</html>
<?php } else {
	header("Location: ../admin/");
}
?>
