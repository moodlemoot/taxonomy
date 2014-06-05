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
	$table->head[] = 'NAME';
	$table->head[] = 'DESCRIPTION';
	$table->head[] = 'WEIGHT';
	$table->head[] = 'ACTIONS';

	$table->size = array('5%', '40%','40%', '5%', '10%');

	$records = taxonomy_vocabulary_list();
	foreach ($records as $key => $record)	{
		$id = $record->id;
		$actions = array();
		$actions[] = html_writer::link(new moodle_url( sprintf('/local/taxonomy/forms/VocabularyEditPage.php?id=%d', $id)), 'Modifier');
		$actions[] = html_writer::link(new moodle_url('/local/taxonomy/toreplace.php'), 'Supprimer');
		$table->data[] = array (
			$id,
			html_writer::link(new moodle_url( sprintf('/local/taxonomy/viewterms.php?id=%d', $id)), $record->name),
			$record->description,
			$record->weight,
			implode('<br/>', $actions)
		);
	}
	echo html_writer::table($table);
	
	$add_new_url = new moodle_url('/local/taxonomy/forms/VocabularyEditPage.php');
	echo html_writer::link($add_new_url, 'Ajouter nouveau vocabulaire');
	
	echo $OUTPUT->footer();

?>
