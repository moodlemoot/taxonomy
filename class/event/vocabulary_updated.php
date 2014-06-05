?php
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
 * The local_taxonomy update vocabulary event.
 *
 * @package    local_taxonomy
 * @copyright  2014 MoodleMootfr
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_taxonomy\event;

defined('MOODLE_INTERNAL') || die();

/**
 * The local_taxonomy update vocabulary event class.
 *
 * @property-read array $other {
 *      Extra information about event.
 *
 *      - int choiceid: id of choice.
 *      - int optionid: id of option.
 * }
 *
 * @package    local_taxonomy
 * @since      Moodle 2.6
 * @copyright  2014 moodlemootfr
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class updated_vocabulary extends \core\event\base {

    /**
     * Returns description of what happened.
     *
     * @return string
     */
    public function get_description() {
        return "The user with id '$this->userid' update the vocabulary with id '$this->objectid' in the taxonomy local plugin";
    }

 
    /**
     * Return localised event name.
     *
     * @return string
     */
    public static function get_name() {
        return get_string('eventvocabularyupdated', 'local_taxonomy');
    }

    /**
     * Get URL related to the action
     *
     * @return \moodle_url
     */
    public function get_url() {
	//@todo change the url page ?
        return new \moodle_url('/local/taxonomy/index.php', array());
    }

    /**
     * Init method.
     *
     * @return void
     */
    protected function init() {
        $this->data['crud'] = 'u';
        $this->data['edulevel'] = self::LEVEL_TEACHING;
        $this->data['objecttable'] = 'vocabulary';
    }
 
}
