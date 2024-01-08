<?php
//URL from which to get webpage contents.
$url = "https://www.wikipedia.org";
 
// Initialize a CURL session.
$newCurl = curl_init();
 
//grab URL and pass it to the variable.
curl_setopt($newCurl, CURLOPT_URL, $url);

// Return Page contents.
curl_setopt($newCurl, CURLOPT_RETURNTRANSFER, true);
 
$output = curl_exec($newCurl);
 
echo $output;
?>