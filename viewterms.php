<?php
		require('../../config.php');
	
	require_login();
	
	$id = required_param('id', PARAM_INT); // Vocabulary id.
	
	$context = context_system::instance();
    	$PAGE->set_context($context);	
	$PAGE->set_url('/local/taxonomy/viewterms.php');
	
	echo $OUTPUT->header();
	echo $OUTPUT->heading('Terms');
		 
	$table = new html_table();

	$table->head = array();
	$table->head[] = 'ID';
	$table->head[] = 'NAME';
	$table->head[] = 'DESCRIPTION';
	$table->head[] = 'WEIGHT';
	$table->head[] = 'ACTIONS';

	$table->size = array('5%', '35%', '40%', '5%', '10%');

	$records = taxonomy_term_list($id);
    if (!empty($records)) {
	foreach ($records as $key => $record)	{
		$id = $record->id;
		$actions = array();
		$actions[] = html_writer::link(new moodle_url( sprintf('/local/taxonomy/forms/TermEditPage.php?id=%d', $id)), 'Modifier');
		$actions[] = html_writer::link(new moodle_url('/local/taxonomy/toreplace.php'), 'Supprimer');
		$table->data[] = array (
			$id,
			$record->name,
			$record->description,
			$record->weight,
			implode('<br/>', $actions)
		);
	}
    } else {
        $table->data[] = array (
            '',
            'Pas de liste',
            '',
            '',
            ''
        );
    }
	echo html_writer::table($table);
	
	$add_new_url = new moodle_url('/local/taxonomy/forms/TermEditPage.php');
	echo html_writer::link($add_new_url, 'Ajouter un nouveau terme');
	
	echo $OUTPUT->footer();
?>

