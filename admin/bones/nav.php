<?php

include("../admin/data.php");

if ($siteExtraEnabledPages === "1") {
    $pagePath = "../*";
    $pageArray = glob($pagePath, GLOB_ONLYDIR);
    
    $nav = "<nav class='pages'>";
    $nav.=  "<a href='../'>Blog</a>";

    foreach ($pageArray as $page) {
        if ($page !== "../admin" && $page !== "../".$siteBlogPageSlug) {
            $name = file_get_contents($page."/name",true);
            $nav .= "<a href='".$page."'>".$name."</a>";
        }
    }
    
    $nav .= "</nav>";
    echo $nav;
}
?>