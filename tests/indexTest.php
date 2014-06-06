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

        /**
         * Try to access 'Taxonomy Page' with authentication and edition activated
         */
        $this->setAdminUser();
        $USER->editing = 1;
        $_SERVER['REQUEST_URI'] = "/local/taxonomy/index.php";
        $_SERVER['REQUEST_METHOD'] = "GET";
        ob_start();
        /* actually, not possible to retrieve index.php output */
        $out = ob_get_contents();
        ob_end_clean();
        $this->assertContains("Vocabulaire", $out);

        /**
         * Try to access 'Add Page' without authentication
         */
        $this->setUser(null);
        $USER->editing = 0;
        $_SERVER['REQUEST_URI'] = "/local/taxonomy/index.php";
        $_SERVER['REQUEST_METHOD'] = "GET";
        ob_start();
        /* actually, not possible to retrieve index.php output */
        $out = ob_get_contents();
        ob_end_clean();
        $this->assertContains("page à accès restreint", $out);
    }
}