<?php

require_once('../../../config.php');
require_once('../lib.php');
    require_login();
    
$id     = required_param('id', PARAM_INT);              // Vocabulary id.
$delete = optional_param('delete', '', PARAM_ALPHANUM); // Delete confirmation hash.

    
$context = context_system::instance();
$PAGE->set_context($context);
	
    
$PAGE->set_url('/local/taxonomy/forms/TermDeletePage.php', array('id' => $id));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('editterm', 'local_taxonomy'));
//$PAGE->set_context(get_context_instance(CONTEXT_SYSTEM));

$site = get_site();


if (! $term = taxonomy_term_load($id) ) {
    print_error("term:notfound", "local_taxonomy");
}

$site = get_site();
$PAGE->set_title($site->fullname);
$PAGE->navbar->add(get_string('navbartaxonomy', 'local_taxonomy'), new moodle_url('/local/taxonomy/index.php'));
    $courseshortname = $term->shortname;
    
if (! $delete) {
    $strdeletecheck = get_string("deletecheck", "", $term->name);
    $strdeletecoursecheck = get_string("term:delete:confirm", 'local_taxonomy');

    $PAGE->navbar->add($strdeletecheck);
    $PAGE->set_title("$site->shortname: $strdeletecheck");
    $PAGE->set_heading($site->fullname);
    echo $OUTPUT->header();

    $message = "$strdeletecoursecheck <br/><br/><b>" . $term->name . "</b>";

    echo $OUTPUT->confirm($message, "TermDeletePage.php?id=$term->id&delete=".md5($term->shortname), "/local/taxonomy/index.php");

    echo $OUTPUT->footer();
    exit;
}

if ($delete != md5($term->shortname)) {
    print_error("invalidmd5");
}

if (!confirm_sesskey()) {
    print_error('confirmsesskeybad', 'error');
}

// OK checks done, delete the course now.

$strdeletingcourse = get_string("deletingcourse", "", $courseshortname);

$PAGE->navbar->add($strdeletingcourse);
$PAGE->set_title("$site->shortname: $strdeletingcourse");
$PAGE->set_heading($site->fullname);
echo $OUTPUT->header();
echo $OUTPUT->heading($strdeletingcourse);

taxonomy_term_delete($term);

echo $OUTPUT->continue_button("/local/taxonomy/index.php");
echo $OUTPUT->footer();
