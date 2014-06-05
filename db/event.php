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
 * @category event
 * @copyright 2014 MoodleMootFr  
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// List of observers.
$observers = array(

    /*array(
        'eventname' => '\core\event\course_deleted',
        'callback'  => 'local_taxonomy_observer::course_deleted',
    ),
    //exemple pour ecouter les evenement interne au module
    array (
                'eventname' => '\mod_evanum\event\evanum_created',
                'includefile' => '/mod/evanum/locallib.php',
                'callback' => 'evanum_created_handler',
                'priority' => 50,
                'internal' => false
    ),
    array (
                'eventname' => '\local_taxonomy\event\evanum_updated',
                'includefile' => '/mod/evanum/locallib.php',
                'callback' => 'evanum_updated_handler',
                'priority' => 50,
                'internal' => false
    )
    
    
    
);
