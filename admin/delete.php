<?php
session_start();

if (isset($_SESSION["in"]) && $_SESSION["in"] === 1 && isset($_GET["id"])) { 
    $dirname = $_GET["id"];
    array_map('unlink', glob("../p/$dirname/*.*"));
    rmdir("../p/".$dirname);
    header("Location: ../admin/");
} else {
	header("Location: ../login/");
}
?>
