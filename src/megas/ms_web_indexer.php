<?php
include_once('simple_html_dom.php');

include_once 'db/connect_db.php';
include_once 'db/db_exec_query.php';
include_once 'db/db_get1_query.php';
include_once 'db/db_insert_query.php';
include_once 'urls/get_full_domain.php';
include_once 'urls/add_new_url.php';
include_once 'urls/make_url.php';
include_once 'urls/make_url_link.php';
include_once 'queue/check_queue.php';
include_once 'queue/fill_queue.php';
include_once 'queue/start_queue.php';
include_once 'queue/stop_queue.php';
include_once 'queue/mark_url_queue.php';
include_once 'keywords/get_keyword_id.php';
include_once 'keywords/extract_and_save.php';

$cs = db_exec_query("SET NAMES utf8;");

$id_queue = null;
do {
	if (!empty($id_queue)) {
    		// Processing URLs in session
    		$q = db_exec_query("SELECT url_id from ms_queue_list where queue_id = ".$id_queue);
    		// Proccesing each URL
        	while ($qi = mysqli_fetch_assoc($q)) {
	     		$result = db_exec_query("SELECT u.id, u.title, u.description, u.keywords FROM ms_url u, ms_domain d where d.id = u.id_domain and u.id = ".$qi["url_id"]);
	     		$row = mysqli_fetch_assoc($result);	
            	$title = $row["title"];
            	$descr = $row["description"];
            	$keywords = $row["keywords"];
            	$id = $row["id"];
            	$url = make_url($id);
           		print "URL is indexing: {$url} ";
     			extract_and_save($descr, $id, ' ');	    
     			extract_and_save($title, $id, ' ');	    
   	     		extract_and_save($keywords, $id, ',');	    
           		print PHP_EOL;
	     		mark_url_queue($id_queue, $id, 3);	
        	}
    		mysqli_free_result($result);    
		$id_queue = stop_queue($id_queue);
	}
    mysqli_free_result($qi);    
	$id_queue = start_queue(3);
} while (!empty($id_queue))?>