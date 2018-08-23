<?php

function add_new_url ($new_url, $url_domain){
    $new_id = null;
    $new_url = strtolower($new_url);
    $new_url = str_replace(' ','',$new_url);    
       
	$is_bs = substr($new_url, strlen($new_url) - 1, 1);
       if ($is_bs === '/' ) {
       	$new_url = substr($new_url, 0, strlen($new_url) - 1);
       }
              
      $parsed_url = parse_url($new_url);
      @$scheme = strtolower($parsed_url['scheme']);
      
	if ($scheme != 'http') {
          return $new_id;
       };
       
       if (empty($parsed_url['host'])) {
       	if ($new_url[0] === '/') {
              	$new_url = $url_domain . $new_url;
              } else {
                     $new_url = $url_domain . '/' . $new_url;
              }
       } else {
              $url_domain = $parsed_url['scheme'] . '://' . $parsed_url['host'];
       };
       
	$new_url = str_replace("://www.", "://", $new_url);
       $url_domain = str_replace("://www.", "://", $url_domain);

	// check exists URL
       $eu = mysql_query("SELECT id FROM uobo_urls where lower(url) = lower('" . $new_url . "') and domain = '" . $url_domain . "'");
       $num_rows = mysql_num_rows($eu);
       if ($num_rows > 0) {
              $row = mysql_fetch_row($eu);
              $new_id = $row[0];
       } else {
              // insert new url into db
              $ins_res = mysql_query("insert into uobo_urls (url, domain) values('" . $new_url . "', '" . $url_domain . "')");
              if ($ins_res) {
                    $new_id = mysql_insert_id();
                    // check exists domain
                    $eu = mysql_query("SELECT id FROM uobo_domains where domain = '" . $url_domain."'");
                    $num_rows = mysql_num_rows($eu);
                    if ($num_rows < 1) {
                        // insert new file url into db
                        $ins_res = mysql_query("insert into uobo_domains (domain) values('" . $url_domain . "')");
                    }    
             }
       }    

	return $new_id;
}

?>
