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
 * Create vocabulary form definition.
 *
 * @package local_taxonomy
 * @category forms
 * @copyright 2014 MoodleMootFr  
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once '../../../config.php';

//moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");


/**
 * Description of VocabularyCreate
 *
 * @author moodlemootfr 2014
 */
class VocabularyEditForm extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
 
        $mform = $this->_form; // Don't forget the underscore! 
 
        
        $mform->addElement('hidden', 'ID', '0');
        
        $mform->addElement('text', 'shortname', 'Please enter a shortname for your vocabulary'); // Add elements to your form
        $mform->setType('shortname', PARAM_TEXT);                   //Set type of element
        $mform->addRule('shortname', get_string('error'), 'required', 'extraruledata', 'server', false, false);
        $mform->setType('shortname', PARAM_TEXT);                   //Set type of element
        $mform->addRule('shortname', get_string('error'), 'maxlength', '255', 'server', false, false);
        // doit etre unique
        
        $mform->addElement('text', 'name', 'Please enter a name for your vocabulary'); // Add elements to your form
        $mform->setType('name', PARAM_TEXT);                   //Set type of element
        $mform->addRule('name', get_string('error'), 'required', 'extraruledata', 'server', false, false);
        $mform->addRule('name', get_string('error'), 'maxlength', '255', 'server', false, false);


        
        $mform->addElement('textarea', 'description', 'Please enter a description for your vocabulary', 'wrap="virtual" rows="10" cols="50"');
        $mform->setType('description', PARAM_TEXT);                   //Set type of element
        //$mform->setDefault('description', 'Please enter a description for your vocabulary');        //Default value
        
        //tableau contenant le poids du voc
        $array_weight=array();
        for ($cpt=-50; $cpt<50; $cpt++){
        $array_weight[]=$cpt;
        }
        
        $mform->addElement('select', 'weight', 'Weight of the vocabulary', $array_weight);
        $mform->setType('weight', PARAM_TEXT);                   //Set type of element
        $mform->addRule('weight', get_string('error'), 'numeric', 'extraruledata', 'server', false, false);
        ////
        $mform->setDefault('weight', '0');        //Default value
        
        $buttonarray=array();
        $buttonarray[] =& $mform->createElement('submit', 'submitbutton', get_string('savechanges'));
        $buttonarray[] =& $mform->createElement('submit', 'cancel', get_string('cancel'));
        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);
         
    }
    //Custom validation should be added here
    function validation($data, $files) {
        
        
        global $DB;
        $errors = parent::validation($data, $files);

        // Add field validation check for duplicate shortname.
        if ($vocabulary= $DB->get_record('vocabulary', array('shortname' => $data['shortname']), '*', IGNORE_MULTIPLE)) {
            if (empty($data['id']) || $vocabulary->id != $data['id']) {
                $errors['shortname'] = 'this shortmane is already used';
                
            }
        }

        return $errors;
    }
}
