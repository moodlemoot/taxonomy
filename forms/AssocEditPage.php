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
 * @copyright 2014 MoodleMootFr
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../../config.php');
require_once('../lib.php');

$context = context_system::instance();
$PAGE->set_context($context);

$tid = optional_param('tid', 0, PARAM_INT); // Term id.
$instanceid = optional_param('instanceid', 0, PARAM_INT); // Instance id.
$componenttype= optional_param('componenttype', null , PARAM_TEXT); // Instance id.

$PAGE->set_url('/local/taxonomy/forms/AssocEditPage.php', array('tid' => $tid, 'instanceid' => $instanceid, 'componenttype' => $componenttype));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading('Edit Assoc');

require_once('./AssocEditForm.php');

//$term = taxonomy_term_load($id);

$form = new AssocEditForm(NULL, array('tid'=>$tid,'instanceid'=>$instanceid,'componenttype'=>$componenttype));

//Form processing and displaying is done here
if ($form->is_cancelled() ) {

    //Handle form cancel operation, if cancel button is present on form
    $url = new moodle_url($CFG->wwwroot.'/local/taxonomy/index.php');
    redirect($url);

} else if ($data = $form->get_data()) {

    if ( empty($term->id) ) {
        // create
      //  $term = taxonomy_term_create($data);
    } else {
        // edit
       // $term = taxonomy_term_update($data);
    }

    $url = new moodle_url("$CFG->wwwroot/local/taxonomy/index.php");
    redirect($url);

} else {
    $site = get_site();
    $PAGE->set_title($site->fullname);
    $PAGE->navbar->add('Taxonomy', new moodle_url('/local/taxonomy/index.php'));

    echo $OUTPUT->header();

    if ( empty($term->id) ) {
        echo $OUTPUT->heading('Créer une nouvelle assoc');
    } else {
        echo $OUTPUT->heading('Modifier l association ' . $term->name);
    }

    $form->display();
    echo $OUTPUT->footer();
}

?>
