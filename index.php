<?php
  require('../../config.php');
	
	$results = $DB->get_records_sql('SELECT * FROM {vocabulary} WHERE 1 = 1');
	var_dump($results);
?>
