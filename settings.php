<?php

defined('MOODLE_INTERNAL') || die();

if ( $ADMIN ) {

    $taxonomy_admin_page = new admin_externalpage(
        'local_taxonomy',
        'Taxonomy',
        "$CFG->wwwroot/local/taxonomy/index.php",
        'moodle/site:config'
    );
    $ADMIN->add('root', $taxonomy_admin_page);
}

