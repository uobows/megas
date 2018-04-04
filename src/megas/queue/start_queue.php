<?php

function start_queue ($q_type){
	$id_queue = null;
	$may_start = check_queue($q_type);
	if ($may_start == 1) {
		$id_queue = db_insert_query("insert into ms_queue (start_queue, type) values(now(),".$q_type.")");
		$queue_state = fill_queue($id_queue, $q_type);
		$q_c = db_get1_query("select count(*) from ms_queue_list where queue_id = ".$id_queue);
		if ($q_c == 0) {
			$q_d = db_exec_query("delete from ms_queue where id = ".$id_queue);
			$id_queue = null;
		}
	}
	return $id_queue;
}

?>
