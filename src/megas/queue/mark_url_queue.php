<?php

function mark_url_queue ($queue, $url, $state){
	$res = db_exec_query("update ms_queue_list set state = ".$state." where queue_id = ".$queue." and url_id = ".$url);
	$res = db_exec_query("delete from ms_global_queue where id_url = ".$url." and type in (select t.type from ms_queue t where t.id = ".$queue.")");
	$res = db_exec_query("update ms_queue set stop_queue = now() where id = ".$queue);
}

?>
