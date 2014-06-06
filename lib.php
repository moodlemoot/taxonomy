<?php


function taxonomy_vocabulary_list() {
    global $DB;

    return $DB->get_records_sql('SELECT * FROM {taxonomy_vocabulary} ORDER by weight desc');
}

/**
 * Load vocabulary by id
 *
 * @param int $id
 * @return mixed returns vocabulary database record or false if none found
 */
function taxonomy_vocabulary_load($id) {
    global $DB;

    return $DB->get_record('taxonomy_vocabulary', array('id' => $id));
}

function taxonomy_vocabulary_create($vocabulary) {
    global $DB;

    if (!isset($vocabulary->name)) {
        throw new coding_exception(get_string('missingvocabularyname','local_taxonomy'));
    }

    if (!isset($vocabulary->shortname)) {
        throw new coding_exception(get_string('missingvocabularyshortname','local_taxonomy'));
    }

    if (!isset($vocabulary->description)) {
        $vocabulary->description = '';
    }

    if (!isset($vocabulary->weight)) {
        $vocabulary->weight = 0;
    }

    $vocabulary->id = $DB->insert_record('taxonomy_vocabulary', $vocabulary);

    // trigger event
    /*
    $event = \local\taxonomy\vocabulary_created::create(array(
        'objectid' => $vocabulary->id,
    ));
    $event->add_record_snapshot('taxonomy_vocabulary', $vocabulary);
    $event->trigger();
    */

    return $vocabulary->id;
}

function taxonomy_vocabulary_update($vocabulary) {
    global $DB;

    $result = $DB->update_record('taxonomy_vocabulary', $vocabulary);

    // trigger event
    /*
    $event = \local\taxonomy\vocabulary_updated::create(array(
        'objectid' => $vocabulary->id,
    ));
    $event->add_record_snapshot('taxonomy_vocabulary', $vocabulary);
    $event->trigger();
    */

    return $result;
}

function taxonomy_vocabulary_delete($vocabulary) {
    global $DB;

    // delete terms
    $result = $DB->delete_records('taxonomy_term', array('vid' => $vocabulary->id));
    // delete vocabulary
    $result = $DB->delete_records('taxonomy_vocabulary', array('id' => $vocabulary->id));

    // trigger event
    /*
    $event = \local\taxonomy\vocabulary_deleted::create(array(
        'objectid' => $vocabulary->id,
    ));
    $event->add_record_snapshot('taxonomy_vocabulary', $vocabulary);
    $event->trigger();
    */

    return $result;
}

function taxonomy_term_list($vid) {
    global $DB;

    return $DB->get_records_sql('SELECT * FROM {taxonomy_term} WHERE vid = ? ORDER by weight desc', array($vid));
}

function taxonomy_term_load($id) {
    global $DB;

    return $DB->get_record('taxonomy_term', array('id' => $id));
}

function taxonomy_term_create($term) {
    global $DB;

    if (!isset($term->name)) {
        throw new coding_exception(get_string('missingtermname','local_taxonomy'));
    }

    if (!isset($term->shortname)) {
        throw new coding_exception(get_string('missingtermshortname','local_taxonomy'));
    }

    if (!isset($term->description)) {
        $term->description = '';
    }

    if (!isset($term->weight)) {
        $term->weight = 0;
    }

    $term->id = $DB->insert_record('taxonomy_term', $term);

    // trigger event
    /*
    $event = \local\taxonomy\term_created::create(array(
        'objectid' => $term->id,
    ));
    $event->add_record_snapshot('taxonomy_term', $term);
    $event->trigger();
    */

    return $term->id;
}

function taxonomy_term_update($term) {
    global $DB;

    $result = $DB->update_record('taxonomy_term', $term);

    // trigger event
    /*
    $event = \local\taxonomy\term_updated::create(array(
        'objectid' => $term->id,
    ));
    $event->add_record_snapshot('taxonomy_term', $term);
    $event->trigger();
    */

    return $result;
}

function taxonomy_term_delete($term) {
    global $DB;

    $result = $DB->delete_records('taxonomy_term', array('id' => $term->id));

    // trigger event
    /*
    $event = \local\taxonomy\term_deleted::create(array(
        'objectid' => $term->id,
    ));
    $event->add_record_snapshot('taxonomy_term', $term);
    $event->trigger();
    */

    return $result;
}

function taxonomy_term_data_load($term_data) {
    global $DB;

    return $DB->get_record('taxonomy_term_data', array('id' => $term_data->id));
}

function taxonomy_term_data_add($term_data) {
    global $DB;

    if ( false === taxonomy_term_load($term_data->term_id)) {
        throw new coding_exception(get_string('term:notfound','local_taxonomy'));
    }

    if ( !isset($term_data->instance_id) ) {
        throw new coding_exception( get_string('instance:missing','local_taxonomy') );
    }

    if ( !isset($term_data->component) ) {
        throw new coding_exception( get_string('component:missing','local_taxonomy') );
    }

    $term_data->id = $DB->insert_record('taxonomy_term_data', $term_data);

    return $term_data->id;
}

function taxonomy_term_data_remove($term_data) {
    global $DB;

    $result = $DB->delete_records('taxonomy_term_data', array('id' => $term_data->id));

    return $result;
}
