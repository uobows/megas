<?php

function stop_queue ($id_queue){
	$type = db_get1_query("select type from ms_queue where id = ".$id_queue);
	//$res = db_exec_query("delete from ms_global_queue where id_url in (select url_id from ms_queue_list where queue_id = ".$id_queue." and state = 1) and type = ".$type);
	$res = db_exec_query("update ms_queue set stop_queue = now() where id = ".$id_queue);
	$res = db_exec_query("delete from ms_queue where id = ".$id_queue);
	return $id_queue;
}

?>
