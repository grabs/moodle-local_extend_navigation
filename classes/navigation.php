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
 * Adds a "Back to Course" menu item to the global navigation.
 *
 * @package    local_extend_navigation
 * @copyright  2021 (http://www.grabs-edv.de)
 * @author     Andreas Grabs
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_extend_navigation;

/**
 * Adds a "Back to Course" menu item to the global navigation.
 *
 * This function checks if the current page is within a course context, and if so, adds a menu item to the global navigation
 * that links back to the course view page. The menu item is marked as active if the current URL matches the course view URL.
 *
 * @param \global_navigation $navigation the global navigation object to add the menu item to
 */
class navigation {

    /**
     * Adds a "Back to Course" menu item to the global navigation by using javascript.
     *
     * This function checks if the current page is within a course context, and if so, adds a menu item to the global navigation
     * that links back to the course view page. The menu item is marked as active if the current URL matches the course view URL.
     */
    public static function add_backtocourse_menu() {
        global $COURSE, $PAGE;

        if (!empty($COURSE->id) && ($COURSE->id !== SITEID)) {
            $context = \context_course::instance($COURSE->id);
            $url     = new \moodle_url('/course/view.php', ['id' => $COURSE->id]);

            // Compare the current url.
            $currenturl = new \moodle_url($PAGE->url);
            $currenturl->remove_all_params();
            $active = false;
            if ($url->out() == $currenturl->out()) {
                $active = true;
            }

            $PAGE->requires->js_call_amd(
                'local_extend_navigation/backtocourse_menu_item',
                'init',
                [
                    get_string('backtocourse', 'local_extend_navigation'),
                    $url->out(),
                    $context->id,
                    $active,
                ]
            );
        }
    }
}
