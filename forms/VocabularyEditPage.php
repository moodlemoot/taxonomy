<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Forum event handler definition.
 *
 * @package local_taxonomy
 * @category forms
 * @link http://docs.moodle.org/dev/Form_API
 * @copyright 2014 MoodleMootFr
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../../config.php');
require_once('../lib.php');

$context = context_system::instance();
$PAGE->set_context($context);

$id = optional_param('id', 0, PARAM_INT); // Vocabulary id.

$PAGE->set_url('/local/taxonomy/forms/VocabularyEditPage.php', array('id' => $id));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('editvocabulary', 'local_taxonomy'));

require_once('./VocabularyEditForm.php');

$vocabulary = taxonomy_vocabulary_load($id);

$form = new VocabularyEditForm(NULL, array('vocabulary'=>$vocabulary));

//Form processing and displaying is done here
if ($form->is_cancelled() ) {

    //Handle form cancel operation, if cancel button is present on form
    $url = new moodle_url($CFG->wwwroot.'/local/taxonomy/index.php');
    redirect($url);

} else if ($data = $form->get_data()) {

    if ( empty($vocabulary->id) ) {
        // create
        $vocabulary = taxonomy_vocabulary_create($data);
    } else {
        // edit
        $vocabulary = taxonomy_vocabulary_update($data);
    }

    $url = new moodle_url("$CFG->wwwroot/local/taxonomy/index.php");
    redirect($url);

} else {
    $site = get_site();
    $PAGE->set_title($site->fullname);
    $PAGE->navbar->add(get_string('navbartaxonomy', 'local_taxonomy'), new moodle_url('/local/taxonomy/index.php'));

    echo $OUTPUT->header();

    if ( empty($vocabulary->id) ) {
        echo $OUTPUT->heading(get_string('createnewvocabulary', 'local_taxonomy'));
    } else {
        echo $OUTPUT->heading(get_string('modifyvocabulary', 'local_taxonomy') . $vocabulary->name);
    }

    $form->display();
    echo $OUTPUT->footer();
}
