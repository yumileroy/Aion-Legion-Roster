<?php
require('inc/php/config.php');

/* Checks for presence of the cURL extension. */
function _iscurlinstalled() {
    if (in_array  ('curl', get_loaded_extensions())) {
        return true;
    }
    else{
        return false;
    }
}

/* Function to use curl like file_get_contents */
function file_get_contents_curl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

/* Function to download multiple files using curl simultaneously */
function file_multi_get_curl($urls, $save_to)
{
    $mh = curl_multi_init();
    foreach ($urls as $i => $url) {
        $g=$save_to."legion".$i++.".html";
        if(!is_file($g) || (time() - filemtime($save_to."legion".$i++.".html") >= $cachetime)){
            $conn[$i]=curl_init($url);
            $fp[$i]=fopen ($g, "w");
            curl_setopt ($conn[$i], CURLOPT_FILE, $fp[$i]);
            curl_setopt ($conn[$i], CURLOPT_HEADER ,0);
            curl_setopt($conn[$i],CURLOPT_CONNECTTIMEOUT,60);
            curl_multi_add_handle ($mh,$conn[$i]);
        }
    }
    do {
        $n=curl_multi_exec($mh,$active);
    }
    while ($active);
    foreach ($urls as $i => $url) {
        curl_multi_remove_handle($mh,$conn[$i]);
        curl_close($conn[$i]);
        fclose ($fp[$i]);
    }
    curl_multi_close($mh);
}
?>
