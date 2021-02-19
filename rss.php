<?php
include("admin/data.php");
$url  = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
$url .= $_SERVER['SERVER_NAME'];
$url .= htmlspecialchars($_SERVER['REQUEST_URI']);
$blogURL = (dirname($url));

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

 header( "Content-type: text/xml");
 
 echo "<?xml version='1.0' encoding='UTF-8'?>
 <rss version='2.0'>
 <channel>
 <title>".$siteName."</title>
 <link>".$blogURL."</link>
 <description>".$siteDescription."</description>";
 
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
    echo "<item>";
    echo "<title>".$single['name']."</title>";
    echo "<pubDate>".$single['date']."</pubDate>";
    echo "<link>".dirname($url)."/".$siteBlogPageSlug."/".$single['slug']."</link>";
    echo "<description>".$single['perex']."</description>";
    echo "</item>";
}

 echo "</channel></rss>";
?>