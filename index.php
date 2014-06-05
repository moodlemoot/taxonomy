<?php
  	require('../../config.php');
	require_once('lib.php');
	
	require_login();
	
	echo $OUTPUT->header();
	echo $OUTPUT->heading('-- TOREPLACE --');
		
	$table = new html_table();

	$table->head = array();
	$table->head[] = 'ID';
	$table->head[] = 'SHORTNAME';
	$table->head[] = 'NAME';
	$table->head[] = 'DESCRIPTION';

	$table->size = array('10%', '25%', '35%','30%');

	$records = $DB->get_records('vocabulary', null, 'id DESC', '*');
	foreach ($records as $key => $record)	{
		$table->data[] = array (
			$record->id,
			$record->shortname,
			$record->name,
			$record->description
		);
	}

	echo html_writer::table($table);
	echo $OUTPUT->footer();
?>
