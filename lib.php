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
 * Library of hook functions to manipulate the navigation or do some other stuff.
 * @package    local_extend_navigation
 * @author     Andreas Grabs <info@grabs-edv.de>
 * @copyright  2020 Andreas Grabs EDV-Beratung
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Extends the global navigation.
 *
 * @param global_navigation $navigation The global navigation object to extend.
 */
function local_extend_navigation_extend_navigation(global_navigation $navigation) {
    global $COURSE;

    // Add button to the navigation bar by using javascript.
    if (!empty($COURSE->id) && ($COURSE->id !== SITEID)) {
        \local_extend_navigation\navigation::add_backtocourse_menu();
    }

    return;
}

/******************************************************************************
 * Fragment calls
 ******************************************************************************/
/**
 * Get fragments.
 *
 * @param mixed $args An array or object with context and parameters needed to get the data.
 * @return string The html fragment we want to use by ajax
 */
function local_extend_navigation_output_fragment_get_html($args) {
    return \local_extend_navigation\output\fragment\fragment_util::get_html($args);
}
