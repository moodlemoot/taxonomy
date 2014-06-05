<?php
	require('../../config.php');
	
	require_login();
	
	$id = required_param('id', PARAM_INT); // Vocabulary id.
	
	$context = context_system::instance();
    $PAGE->set_context($context);
	$PAGE->set_url('/local/taxonomy/viewterms.php');
    $PAGE->set_pagelayout('standard');
    $PAGE->navbar->add(get_string('navbartaxonomy','local_taxonomy'), new moodle_url('/local/taxonomy/index.php'));
	
	echo $OUTPUT->header();
	echo $OUTPUT->heading(get_string('termtitle', 'local_taxonomy'));
		 
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
		$tid = $record->id;
		$actions = array();
		$actions[] = html_writer::link(new moodle_url( sprintf('/local/taxonomy/forms/TermEditPage.php?id=%d', $tid)), get_string('modifyterm', 'local_taxonomy'));
		$actions[] = html_writer::link(new moodle_url( sprintf('/local/taxonomy/forms/TermDeletePage.php?id=%d', $tid)), get_string('deleteterm', 'local_taxonomy'));

		$table->data[] = array (
			$tid,
			$record->name,
			$record->description,
			$record->weight,
			implode('<br/>', $actions)
		);
	}
    } else {
        $table->data[] = array (
            '',
            get_string('noTerms','local_taxonomy'),
            '',
            '',
            ''
        );
    }
	echo html_writer::table($table);
	
	$add_new_url = new moodle_url('/local/taxonomy/forms/TermEditPage.php');
	echo html_writer::link($add_new_url, get_string('addnewterm', 'local_taxonomy'));
	
	echo $OUTPUT->footer();
?>

