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
 * Fragment util class to handle fragment calls.
 *
 * @package    local_extend_navigation
 * @copyright  2021 (http://www.grabs-edv.de)
 * @author     Andreas Grabs
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_extend_navigation\output\fragment;

/**
 * Utility class for handling fragment calls in the local_extend_navigation plugin.
 *
 * This class provides methods to generate HTML fragments for various navigation menu items,
 * such as the "Back to Course" menu item in the "More" menu and the mobile menu.
 */
class fragment_util {
    /**
     * Returns the html fragment
     *
     * @throws \moodle_exception
     * @param array $args
     * @return string
     */
    public static function get_html($args) {
        if (empty($args['function'])) {
            throw new \moodle_exception('missing argument "function"');
        }
        switch ($args['function']) {
            case 'get_backtocourse_moremenu_item':
                return static::get_backtocourse_moremenu_item($args);
            case 'get_backtocourse_mobilemenu_item':
                return static::get_backtocourse_mobilemenu_item($args);
            default:
                throw new \moodle_exception('unknown function "'.$args['function'].'"');
        }
    }

    /**
     * Returns the HTML fragment for the "Back to Course" menu item in the "More" menu.
     *
     * @param array $args An associative array containing the following keys:
     *   - title: The title of the menu item.
     *   - panelurl: The URL of the panel associated with the menu item.
     *   - active: A boolean indicating whether the menu item is active.
     * @return string The HTML fragment for the menu item.
     */
    public static function get_backtocourse_moremenu_item($args) {
        global $OUTPUT;

        $title = $args['title'] ?? '';
        $url = $args['url'] ?? '';
        $active = $args['active'] ?? '';
        $menuitem = new \local_extend_navigation\output\components\backtocourse_menu_item($title, $url, $active);
        return $OUTPUT->render($menuitem);
    }

    /**
     * Returns the HTML fragment for the "Back to Course" menu item in the mobile menu.
     *
     * @param array $args An associative array containing the following keys:
     *   - title: The title of the menu item.
     *   - panelurl: The URL of the panel associated with the menu item.
     *   - active: A boolean indicating whether the menu item is active.
     * @return string The HTML fragment for the menu item.
     */
    public static function get_backtocourse_mobilemenu_item($args) {
        global $OUTPUT;

        $title = $args['title'] ?? '';
        $url = $args['url'] ?? '';
        $active = $args['active'] ?? '';
        $menuitem = new \local_extend_navigation\output\components\backtocourse_menu_item($title, $url, $active, true);
        return $OUTPUT->render($menuitem);
    }
}
