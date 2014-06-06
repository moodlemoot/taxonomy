<?php
require('../../config.php');

require_login();

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url('/local/taxonomy/index.php');
$PAGE->set_pagelayout('standard');
$PAGE->set_heading('Taxonomy');

$site = get_site();
$PAGE->set_title($site->fullname);
$PAGE->navbar->add(get_string('navbartaxonomy','local_taxonomy'),new moodle_url('/local/taxonomy/index.php'));

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('vocabularytitle', 'local_taxonomy'));

$table = new html_table();

$table->head = array();
$table->head[] = 'ID';
$table->head[] = 'NAME';
$table->head[] = 'DESCRIPTION';
$table->head[] = 'WEIGHT';
$table->head[] = 'ACTIONS';

$table->size = array('5%', '40%','40%', '5%', '10%');

$records = taxonomy_vocabulary_list();
foreach ($records as $key => $record) {
    $id = $record->id;
    $actions = array();
    $actions[] = html_writer::link(new moodle_url( sprintf('/local/taxonomy/forms/VocabularyEditPage.php?id=%d', $id)), get_string('modifyvocabulary', 'local_taxonomy'));
    $actions[] = html_writer::link(new moodle_url( sprintf('/local/taxonomy/forms/VocabularyDeletePage.php?id=%d', $id)), get_string('deletevocabulary', 'local_taxonomy'));

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
echo html_writer::link($add_new_url, get_string('addnewvocabulary', 'local_taxonomy'));

echo $OUTPUT->footer();
?>
