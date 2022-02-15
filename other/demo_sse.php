<?php
	header('Content-Type: text/event-stream');
	header('Cache-Control: no-cache');
	echo "string\n";
	
	flush();
?>