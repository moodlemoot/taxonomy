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

defined('MOODLE_INTERNAL') || die;

//moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");


/**
 * Description of TermCreate
 *
 * @author moodlemootfr 2014
 */
class TermEditForm extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore!

        $term = $this->_customdata['term']; // this contains the data of this form
        $vid = $this->_customdata['vid']; // this contains the data of this form

        $data = taxonomy_vocabulary_list();
        $vocabularies = array();
        foreach($data as $vocabulary){
            $vocabularies[$vocabulary->id] = $vocabulary->name;
        }
        $mform->addElement('select','vid','Vocabulaire', $vocabularies);
        $mform->setType('vid', PARAM_INT);
        $mform->addRule('vid', get_string('error'), 'required');
        if(!empty($vid)){
            $mform->setDefault('vid', $vid);
        }

        $mform->addElement('text', 'name', 'Nom'); // Add elements to your form
        $mform->setType('name', PARAM_TEXT);                   //Set type of element
        $mform->addRule('name', get_string('error'), 'required', 'extraruledata', 'server', false, false);
        $mform->addRule('name', get_string('error'), 'maxlength', '255', 'server', false, false);

        $mform->addElement('text', 'shortname', 'Nom court'); // Add elements to your form
        $mform->setType('shortname', PARAM_TEXT);                   //Set type of element
        $mform->addRule('shortname', get_string('error'), 'required', 'extraruledata', 'server', false, false);
        $mform->setType('shortname', PARAM_TEXT);                   //Set type of element
        $mform->addRule('shortname', get_string('error'), 'maxlength', '255', 'server', false, false);
        // doit etre unique


        $mform->addElement('textarea', 'description', 'Description', 'wrap="virtual" rows="10" cols="50"');
        $mform->setType('description', PARAM_TEXT);                   //Set type of element

        //tableau contenant le poids du terme
        $array_weight=array();
        for ($cpt = -50; $cpt <= 50; $cpt++) {
            $array_weight[$cpt] = $cpt;
        }

        $mform->addElement('select', 'weight', 'Poids', $array_weight);
        $mform->setType('weight', PARAM_INT);
        $mform->setDefault('weight', 0);

        $this->add_action_buttons();

        $mform->addElement('hidden', 'id', null);
        $mform->setType('id', PARAM_INT);

        // Finally set the current form data
        $this->set_data($term);
    }

    //Custom validation should be added here
    function validation($data, $files) {
        global $DB;

        $errors = parent::validation($data, $files);

        // Add field validation check for duplicate shortname.
        if ($term= $DB->get_record('taxonomy_term', array('shortname' => $data['shortname']), '*', IGNORE_MULTIPLE)) {
            if (empty($data['id']) || $term->id != $data['id']) {
                $errors['shortname'] = 'this shortmane is already used';
            }
        }

        return $errors;
    }
}
