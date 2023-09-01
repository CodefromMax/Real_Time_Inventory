<?php

define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DATABASE","inv");

$connect = new mysqli(HOSTNAME,USERNAME,PASSWORD,DATABASE);

if(!$connect) {
    die("Connection failed");
}

else {
    
    // echo "connected";
}