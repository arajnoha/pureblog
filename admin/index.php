<?php
session_start();

if (isset($_SESSION["in"]) && $_SESSION["in"] === 1) { 
	include("data.php");
?>
		
	<!doctype html>
	<html>
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
		<?php 

		if ($siteExtraEnabledPages === "1") {
			$pagePath = "../*";
			$pageArray = glob($pagePath, GLOB_ONLYDIR);
			
			$nav = "<nav class='pages'>";
			$nav.=  "<a href='../'>Blog</a>";

			foreach ($pageArray as $page) {
				if ($page !== "../admin" && $page !== "../".$siteBlogPageSlug && file_exists($page."/name")) {
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
		
		
		?>



		<nav>
			<a href="write.php" class="graylink">Write post</a>
			<?php if ($siteExtraEnabledPages === "1") { 
				echo '<a href="addpage.php" class="graylink">Add page</a>'; 
				} ?>
			<a href="settings.php" class="graylink">Settings</a>
			<a href="logout.php" class="graylink">Log out</a>
		</nav>
		<?php 
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

		// Reconstruct all posts from /p/
		$postPath = "../".$siteBlogPageSlug."/*";
		$postArray = glob($postPath, GLOB_ONLYDIR);
		
        $globalArray = [];
        foreach ($postArray as $single) {
			$singleArray = json_decode(file_get_contents($single."/meta.json"), true);
            array_push($globalArray, $singleArray);
		}
		usort($globalArray, 'datesortdesc');
		
		foreach($globalArray as $single) {
		    echo "<article>";
			echo "<h3><a href='../".$siteBlogPageSlug."/".$single['slug']."'>".$single['name']."</a></h3>";
		    echo "<span>".$single['date']."</span>";
			echo "<p>".$single['perex']."</p>";
			echo "<a href='#' data-slug='".$single['slug']."' data-name='".$single['name']."' class='graylink action-delete'>Delete</a>";
			echo "<a href='edit.php?id=".$single['slug']."' class='graylink'>Edit</a>";
		    echo "</article>";
		}

		?>
		</main>
		<script>
			document.addEventListener("click", function(e){
				if (e.target.matches("article .graylink.action-delete")) {
					e.preventDefault();
					if (confirm("Do you really want to delete the post called "+e.target.getAttribute("data-name")+" ?")) {
						window.location.href = "delete.php?id="+e.target.getAttribute("data-slug");
					}
				}
				if (e.target.matches("button.delete-link")) {
					e.preventDefault();
					if (confirm("Do you really want to delete the link "+e.target.previousElementSibling.innerText+" ?")) {
						window.location.href = "deletepage.php?id="+e.target.getAttribute("data-action-delete");
					}
				}
			});
		</script>
	    </body>
	</html>
<?php } else {
	header("Location: ../admin/");
}
?>
