<?php

/**
 * Unit tests
 * 
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package taxonomy
 */
global $CFG;

class index_test extends advanced_testcase 
{

    function testDisplayIndex() 
    {
        global $USER;
        $this->resetAfterTest(true);

        $PAGE = new moodle_page();
        $PAGE->set_context(context_system::instance());

        $this->setAdminUser();
        $USER->editing = 1;
        $out = "";
        $this->assertContains("something", $out);
    }
}