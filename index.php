<?php 
	session_start();
	include("admin/data.php");
	if (isset($_SESSION["in"]) && $_SESSION["in"] === 1) {
		header("Location: admin/");
	}
	?>
<!doctype html>
<html lang="cs">
<head>
		<meta charset="utf-8">
		<title><?=$siteName;?></title>
		<link rel="stylesheet" type="text/css" href="admin/pretty/neon.css">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="description" content="<?=$siteDescription;?>">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet"> 
		<link rel="icon" type="image/png" href="admin/pretty/i/favicon.png">
	    </head>
	    <body>
		<main>
		<header>
			<h2><?=$siteName;?></h2>
			<p><?=$siteDescription;?></p>
		</header>
		<?php 
		
		if ($siteExtraEnabledPages === "1") {
			// roll out page menu if pages exist
			$pagePath = "*";
			$pageArray = glob($pagePath, GLOB_ONLYDIR);
			
			$nav = "<nav class='pages'>";
			$nav.=  "<a href='".$_SERVER['REQUEST_URI']."'>Blog</a>";

			foreach ($pageArray as $page) {
				if ($page !== "admin" && $page !== $siteBlogPageSlug) {
					$name = file_get_contents($page."/name",true);
					if (strpos($name, '</a>') !== false) {
						$nav .= $name;
					} else {
						$nav .= "<a href='".$page."'>".$name."</a>";
					}	
				}
			}
			
			$nav .= "</nav>";
			echo $nav;
		}

		// sorting post function
		function datesortdesc(array $b, array $a) {
			if ($a['timestamp'] < $b['timestamp']) {
				return -1;
			} else if ($a['timestamp'] > $b['timestamp']) {
				return 1;
			} else {
				return 0;
			}
		}

		// Reconstruct all posts
		$postPath = $siteBlogPageSlug."/*";
		$postArray = glob($postPath, GLOB_ONLYDIR);
		
        $globalArray = [];
        foreach ($postArray as $single) {
			$singleArray = json_decode(file_get_contents($single."/meta.json"), true);
            array_push($globalArray, $singleArray);
		}
		usort($globalArray, 'datesortdesc');
		
		foreach($globalArray as $single) {
		    echo "<article>";
			echo "<h3><a href='".$siteBlogPageSlug."/".$single['slug']."'>".$single['name']."</a></h3>";
		    echo "<span>".$single['date']."</span>";
			echo "<p>".$single['perex']."</p>";
		    echo "</article>";
		}

		?>
	<footer>
		<a href="admin/login.php" class="graylink">Log in</a>  |  <a href="https://github.com/arajnoha/pureblog" class="graylink">pureblog project</a>
	</footer>
        </main>
    </body>
</html>

