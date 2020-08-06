<?php

$json = <<<JSON
[
   {
      "color":"#001f3f",
      "id":"1",
      "path":"logos/logo-1.svg"
   
},
   {
      "color":"#0074D9",
      "id":"2",
      "path":"logos/logo-2.svg"
   
},
   {
      "color":"#7FDBFF",
      "id":"3",
      "path":"logos/logo-3.svg"
   
},
   {
      "color":"#39CCCC",
      "id":"4",
      "path":"logos/logo-4.svg"
   
},
   {
      "color":"#3D9970",
      "id":"5",
      "path":"logos/logo-5.svg"
   
},
   {
      "color":"#2ECC40",
      "id":"6",
      "path":"logos/logo-6.svg"
   
},
   {
      "color":"#01FF70",
      "id":"7",
      "path":"logos/logo-7.svg"
   
},
   {
      "color":"#FFDC00",
      "id":"8",
      "path":"logos/logo-8.svg"
   
},
   {
      "color":"#FF851B",
      "id":"9",
      "path":"logos/logo-9.svg"
   
},
   {
      "color":"#FF4136",
      "id":"10",
      "path":"logos/logo-10.svg"
   
},
   {
      "color":"#85144b",
      "id":"11",
      "path":"logos/logo-11.svg"
   
},
   {
      "color":"#B10DC9",
      "id":"12",
      "path":"logos/logo-12.svg"
},
   {
      "color":"#892D2D",
      "id":"13",
      "path":"logos/logo-13.svg"
},
   {
      "color":"#346474",
      "id":"14",
      "path":"logos/logo-14.svg"
},
   {
      "color":"#3A155A",
      "id":"15",
      "path":"logos/logo-15.svg"
},
   {
      "color":"#4E6CFE",
      "id":"16",
      "path":"logos/logo-16.svg"
}
]
JSON;

$list = json_decode($json);
print_r($list);
// randomize the elements in the array:
shuffle($list);

// Send only the first 12 to the App.
$list = array_slice($list, 0, 12);

error_log("REQUEST = " . print_r($_REQUEST, true));

$index = array_slice(array_keys($_REQUEST), 0, 1);
error_log("index = {$index[0]}");
// convert back to JSON for output to AJAX/HTTP requests.
$json = json_encode($list[1]);
error_log(json_last_error_msg());
error_log(count($list) . " JSON elements decoded");
error_log("JSON = '$json'");
echo $json;
