<?php

function translate_content ($content, $from_lang, $to_lang){
    $url = "https://translate.yandex.net/api/v1.5/tr/translate?key=trnsl.1.1.20131028T104824Z.536a64bc78579f45.6b671e8f72caf70a312627fc72ca6627a613ed55&text=";
    $url = $url.urlencode($content);
    $url = $url."&lang=".$to_lang."&format=html";
    
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
        preg_match_all ("/<text>(.*)<\/text>/",  $response, $out);
        print "Origin {$content}".PHP_EOL;
        print "Trans {$out[1][0]}".PHP_EOL;
        $content = $out[1][0];
    }
   
    return $content;
}
?>
