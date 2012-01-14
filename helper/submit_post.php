<?php
require_once ('classes.php');

//$array = array($_GET["author"], $_GET["title"], $_GET["preview"], $_GET["content"], 0);

$array = array($_POST["author"], $_POST["title"], $_POST["preview"], $_POST["content"], 0);

$new_post = new pageObject($array);

$success = $new_post->store();

echo $success;

?>
