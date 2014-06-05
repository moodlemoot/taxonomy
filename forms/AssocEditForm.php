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
error_reporting(E_ALL);

/**
 * Description of TermCreate
 *
 * @author moodlemootfr 2014
 */
class AssocEditForm extends moodleform {

    //Add elements to form
    public function definition() {
        global $CFG;

        $mform = $this->_form; // Don't forget the underscore!

        $tid = $this->_customdata['tid']; // this contains the data of this form
        $instanceid = $this->_customdata['instanceid']; // this contains the data of this form
        $componenttype = $this->_customdata['componenttype']; // this contains the data of this form
        $data = taxonomy_vocabulary_list();
        //var_dump($data);


        foreach ($data as $vocabulary) {
            $terms = null;
            $terms[] = 'Faites votre choix';
            $vocabularies[$vocabulary->id] = $vocabulary->name;
            // il nous faut la liste des termes pour ce vocabulaire 
            $terms_list = taxonomy_term_list($vocabulary->id);
            // var_dump($terms_list);
            foreach ($terms_list as $term) {
                $terms[$term->id] = $term->name;
            }
            //   var_dump($terms);
            $mform->addElement('select', 'voc_id_' . $vocabulary->id, $vocabulary->name, $terms);
            $mform->setType('voc_id_' . $vocabulary->id, PARAM_INT);
            // $mform->addRule('voc'.$vocabulary->id, get_string('error'), 'required');
            //echo "ajout $vocabulary->id : $vocabulary->name";
        }




        $this->add_action_buttons();

        $mform->addElement('hidden', 'tid', $tid);
        $mform->setType('tid', PARAM_INT);

        $mform->addElement('hidden', 'instanceid', $instanceid);
        $mform->setType('instanceid', PARAM_INT);

        $mform->addElement('hidden', 'componenttype', $componenttype);
        $mform->setType('componenttype', PARAM_INT);

        // Finally set the current form data
        //$this->set_data($id);
    }

    //Custom validation should be added here
    function validation($data, $files) {
        global $DB;

        $errors = parent::validation($data, $files);
        $tab_id=array();
        foreach ($data as $key => $value) {
            $pos = strstr($key, "voc_id");
            if ($pos) {
               // echo "found :$key /$value<=> $pos<br>";
                if ($value > 0) {
                    $tab_id[] = $value;
                }
            } else {
               // echo " NOT found :$key /$value<br>";
            }
        }


        var_dump($data);
        var_dump($tab_id);
        
        if (empty($tab_id)){
            $errors['shortname'] = 'please select at least one vocabulary';
            $errors[''] = 'please select at least one vocabulary';
            // todo repositionner l'erreur au bon endroit
        }
            
       
//        // Add field validation check for duplicate shortname.
//        if ($term= $DB->get_record('taxonomy_term', array('shortname' => $data['shortname']), '*', IGNORE_MULTIPLE)) {
//            if (empty($data['id']) || $term->id != $data['id']) {
//                $errors['shortname'] = 'this shortmane is already used';
//            }
//        }

        return $errors;
    }

}
