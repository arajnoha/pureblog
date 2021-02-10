<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include("../admin/data.php");

if ($siteExtraEnabledPages === "1" && isset($_SESSION["in"]) && $_SESSION["in"] === 1) { 
$nav = <<<LOL
<nav class="adminnav">
<a href="../admin/" class="graylink">Return back</a>
<a href="../admin/editpage.php" id="editpage" class="graylink">Edit this page</a>
<a href="#" id="deletepage" class="graylink">Delete this page</a>
</nav>
LOL;
echo $nav;
}
?>