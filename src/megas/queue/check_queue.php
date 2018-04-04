<?php

function check_queue ($q_type){
	$max_running = 1;

	$r = db_exec_query("delete from ms_queue where timestampdiff(MINUTE, stop_queue, now()) > 60");
	$may_start = db_get1_query("SELECT value FROM ms_parametr where name = 'queue_state'");
	if ($may_start == 1) {
		$cur_running = db_get1_query("SELECT count(*) FROM ms_queue where type = ".$q_type);
		if ($cur_running >= $max_running) {
			$may_start = 0;
		}

	}
	
	return $may_start;
}

?>
