<?php

function db_insert_query($query){
    global $link;
    $new_id = null;	
    $result = db_exec_query($query);
    $new_id = mysqli_insert_id($link);
    return $new_id;
}

?>
