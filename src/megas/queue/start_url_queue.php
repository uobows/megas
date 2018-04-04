<?php

function start_url_queue ($queue, $url){
	$res = db_exec_query("update ms_queue set url_in_progress = '".$url."' where id = ".$queue);
}

?>
