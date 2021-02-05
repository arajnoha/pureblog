<?php include("admin/data.php"); ?>
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
			<h2><?=$siteName;?></h2>
			<p><?=$siteDescription;?></p>
		</header>
        <?php 

		// sorting post function
		function datesortdesc(array $b, array $a) {
			if ($a['date'] < $b['date']) {
				return -1;
			} else if ($a['date'] > $b['date']) {
				return 1;
			} else {
				return 0;
			}
		}

		// Reconstruct all posts from /p/
		$postPath = "p/*";
		$postArray = glob($postPath, GLOB_ONLYDIR);
		
        $globalArray = [];
        foreach ($postArray as $single) {
			$singleArray = json_decode(file_get_contents($single."/meta.json"), true);
            array_push($globalArray, $singleArray);
		}
		usort($globalArray, 'datesortdesc');
		
		foreach($globalArray as $single) {
		    echo "<article>";
			echo "<h3><a href='p/".$single['slug']."'>".$single['name']."</a></h3>";
		    echo "<span>".$single['date']."</span>";
			echo "<p>".$single['perex']."</p>";
		    echo "</article>";
		}

		?>
	<footer>
		<a href="login/" class="graylink">Log in</a>
	</footer>
        </main>
    </body>
</html>

