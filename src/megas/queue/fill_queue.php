<?php

function fill_queue ($id_queue, $q_type){
	$id_queue = db_exec_query("insert into ms_queue_list (queue_id, url_id) select ".$id_queue.", q.id_url from ms_global_queue q join ms_url u on u.id = q.id_url left join ms_domain_rule r on r.id_domain = u.id_domain left join ms_content_type t on t.id = u.id_content_type where q.type = ".$q_type." order by r.crawl, t.crawler desc, id_url limit 1000");
//	$id_queue = db_exec_query("insert into ms_queue_list (queue_id, url_id) select ".$id_queue.", q.id_url from ms_global_queue q join ms_url u on u.id = q.id_url where q.id_url not in (select url_id from ms_queue_list l, ms_queue q where q.id = l.queue_id and q.type = ".$q_type.") and q.type = ".$q_type." order by id_url limit 100");
	return 1;
}

?>
