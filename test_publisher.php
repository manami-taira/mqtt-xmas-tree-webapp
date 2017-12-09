<?php

require("phpMQTT.php");

	
$mqtt = new phpMQTT("example.com", 1883, "phpMQTT Test Publisher");

if ($mqtt->connect()) {
	$mqtt->publish("tree",'{"mode":"blink"}');
	$mqtt->close();
}

?>
