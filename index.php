<?php
	require('../../config.php');
	
	require_login();
	
	$context = context_system::instance();
    	$PAGE->set_context($context);	
	$PAGE->set_url('/local/taxonomy/index.php');
	
	echo $OUTPUT->header();
	echo $OUTPUT->heading('Vocabulary');
		 
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
	
	$add_new_url = new moodle_url('/local/taxonomy/toreplace.php');
	//echo html_writer::link($url, 'Ajouter nouveau vocabulaire');
	
	echo $OUTPUT->footer(html_writer::link($add_new_url, 'Ajouter nouveau vocabulaire'));
?>
