<?php

$link = mysqli_connect('localhost:3306', 'onsol', 'onsol', 'megas');

if (!$link) {
    die('Unable to connect: ' . mysqli_error());
}

?>
