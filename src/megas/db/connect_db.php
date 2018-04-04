<?php

$link = mysqli_connect('localhost:3306', 'root', 'root', 'megas');

if (!$link) {
    die('Unable to connect: ' . mysqli_error());
}

?>
