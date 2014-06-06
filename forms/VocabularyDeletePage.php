<?php

require_once('../../../config.php');
require_once('../lib.php');

require_login();
$id     = required_param('id', PARAM_INT);              // Vocabulary id.
$delete = optional_param('delete', '', PARAM_ALPHANUM); // Delete confirmation hash.
    
$context = context_system::instance();

$PAGE->set_context($context);
$PAGE->set_url('/local/taxonomy/forms/VocabularyDeletePage.php', array('id' => $id));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('editvocabulary', 'local_taxonomy'));

$site = get_site();

if (! $vocabulary = taxonomy_vocabulary_load($id) ) {
    print_error("vocabulary:notfound", "local_taxonomy");
}

$PAGE->set_title($site->fullname);
$PAGE->navbar->add(get_string('navbartaxonomy', 'local_taxonomy'), new moodle_url('/local/taxonomy/index.php'));
$courseshortname = $vocabulary->shortname;

if (! $delete) {
        $strdeletecheck = get_string("deletecheck", "", $vocabulary->name);
        $strdeletecoursecheck = get_string("vocabulary:delete:confirm", 'local_taxonomy');

        $PAGE->navbar->add($strdeletecheck);
        $PAGE->set_title("$site->shortname: $strdeletecheck");
        $PAGE->set_heading($site->fullname);
        echo $OUTPUT->header();
        $message = "$strdeletecoursecheck<br/><br/><b style=\"margin-left:80px;\">" . $vocabulary->name ."</b>";
        echo $OUTPUT->confirm($message, "VocabularyDeletePage.php?id=$vocabulary->id&delete=".md5($vocabulary->shortname), "/local/taxonomy/index.php");
        echo $OUTPUT->footer();
        exit;
}

if ($delete != md5($vocabulary->shortname)) {
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

taxonomy_vocabulary_delete($vocabulary);

echo $OUTPUT->continue_button("/local/taxonomy/index.php");
echo $OUTPUT->footer();
