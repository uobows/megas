<?php

function get_content_lang ($content){
    $url = 'https://translate.yandex.net/api/v1.5/tr/detect?key=trnsl.1.1.20131028T104824Z.536a64bc78579f45.6b671e8f72caf70a312627fc72ca6627a613ed55&text=';
    $url = $url.urlencode($content);
    $lang = '';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_NOBODY, FALSE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $response = curl_exec($ch);
    $error = curl_error($ch);
    if ($error != "") {
        print "cURL error: {$error}";
    }
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($http_code === 200) {
        $pos = strpos($response, 'lang="');
        if ($pos !== FALSE) {
            $pos1 = strpos($response, '"', $pos);
            $lang = substr($response, $pos + 6, $pos1 - $pos - 3);
        }
    }
    return strtolower($lang);
}

?>
