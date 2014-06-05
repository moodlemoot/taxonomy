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
require_once '../../../config.php';

$context = context_system::instance();
$PAGE->set_context($context);	

$id = optional_param('id', 0, PARAM_INT); // 0 mean create new.

$urlparams = array('id' => $id);

$PAGE->set_url('/local/taxonomy/forms/VocabularyEditPage.php', $urlparams);
$PAGE->set_pagelayout('standard');
$PAGE->set_heading('Edition Vocabulary');

require_once('./VocabularyEditForm.php');

$mform = new VocabularyEditForm();

if ($id != 0)	{
	$isadding = false;
	$data = $DB->get_record('vocabulary', array('id' => $id), '*', MUST_EXIST);
} else {
	$isadding = true;
	$data = new stdClass;
	$data->id = 0;
}

//Form processing and displaying is done here
if ($mform->is_cancelled() ) {
    //Handle form cancel operation, if cancel button is present on form
    
} else if ($data = $mform->get_data()) {
  
} else {
  // this branch is executed if the form is submitted but the data doesn't validate and the form should be redisplayed
  // or on the first display of the form.
 
  //Set default data (if any)
      $mform->set_data($data);

  //displays the form
  $mform->display();
}

?>
