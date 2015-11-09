<?php
header('Content-disposition: attachment; filename='. urlencode($_GET["fname"]). '.mp3');
header('Content-type: audio/mpeg');


$path_parts = pathinfo($_GET["file"]);

if ($path_parts['extension'] == "mp3"){
	readfile($_GET["file"]);
}
?>