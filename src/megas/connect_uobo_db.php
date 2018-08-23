<?php

$link = mysql_connect('localhost:3306', 'root', 'root');
if (!$link) {
    die('Не удалось соединиться : ' . mysql_error());
}
$db_selected = mysql_select_db('uobo', $link);
if (!$db_selected) {
    die ('Не удалось выбрать базу : ' . mysql_error());
}

?>
