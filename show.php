<?php

header("Content-type: image/jpeg");
$jpeg = fopen("/home/postgres/tmp.jpg","r");
$image = fread($jpeg,filesize("/home/postgres/tmp.jpg"));
echo $image;

?>