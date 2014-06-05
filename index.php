<?php
  	require('../../config.php');
	require_once('lib.php');
	
	require_login();
	
	$PAGE->set_url('/local/taxonomy/index.php');
	echo $OUTPUT->header();
	echo $OUTPUT->heading('Vocabulary');
		
	$taxonomy_list = 
	$table = new html_table();

	$table->head = array();
	$table->head[] = 'ID';
	$table->head[] = 'SHORTNAME';
	$table->head[] = 'NAME';
	$table->head[] = 'DESCRIPTION';
	$table->head[] = 'WEIGHT';

	$table->size = array('5%', '25%', '35%','30%', '5%');

	$records = taxonomy_vocabulary_list();
	foreach ($records as $key => $record)	{
		$table->data[] = array (
			$record->id,
			$record->shortname,
			$record->name,
			$record->description,
			$record->weight
		);
	}

	echo html_writer::table($table);
	echo $OUTPUT->footer();
?>
