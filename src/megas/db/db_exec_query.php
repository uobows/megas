<?php

function db_exec_query($query){
    global $link;
    
    $result = mysqli_query($link, $query);
    if (!$result) {
        $rsd = mysqli_error($link);
        print PHP_EOL."DB query error {$rsd}".PHP_EOL;
        print PHP_EOL."Query {$query}".PHP_EOL;
    }
    return $result;

}

?>
