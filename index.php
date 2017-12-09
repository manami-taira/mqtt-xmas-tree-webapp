<?php

require("phpMQTT.php");

$input_mode = $_POST['mode'];
$err_message = '';

$mqtt = new phpMQTT("example.com", 1883, "Xmas Tree WebApp");

if ($mqtt->connect()) {
    switch($input_mode){
    case 'off':
	$mqtt->publish("tree",'{"mode":"off"}');
        break;
    case 'on':
	$mqtt->publish("tree",'{"mode":"on"}');
        break;
    case 'blink':
	$mqtt->publish("tree",'{"mode":"blink"}');
        break;
    }

    $mqtt->close();
} else {
    $err_message = 'Connection Error:';
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=320,initial-scale=1">
<link rel="stylesheet" href="buttons.css">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.css" rel="stylesheet">
<title>IoT Xmas Tree</title>
</head>
<body>
<div align="center">
<img src="title.png" alt="IoT Xmas Tree" /><br />
<?php
    switch($input_mode){
    case 'off':
	print("状態: 消灯しました");
        break;
    case 'on':
	print("状態: 点灯しました");
        break;
    case 'blink':
	print("状態: 点滅しました");
        break;
    }
?>
<form method="POST" action="index.php">
	<span class="button-wrap">
	<button class="button button-caution button-pill" name="mode" value="off"><i class="fa fa-power-off"></i> 消灯</button>
	</span>
	<br />
	<br />
	<span class="button-wrap">
	<button class="button button-action button-pill" name="mode" value="on"><i class="fa fa-lightbulb-o"></i> 点灯</button>
	</span>
	<br />
	<br />
	<span class="button-wrap">
	<button class="button button-highlight button-pill" name="mode" value="blink"><i class="fa fa-star"></i> 点滅</button>
	</span>
	<br />
</form>
</div>
<br />
<?php print($err_message); ?>
</body>
</html>
