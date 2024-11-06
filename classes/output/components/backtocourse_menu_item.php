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
 * Represents a menu item for a "Back to Course" link.
 *
 * @package    local_extend_navigation
 * @copyright  2021 (http://www.grabs-edv.de)
 * @author     Andreas Grabs
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_extend_navigation\output\components;

/**
 * Represents a menu item for a "Back to Course" link.
 *
 * This class implements the \renderable and \templatable interfaces, allowing it to be
 * rendered using a template.
 */
class backtocourse_menu_item implements \renderable, \templatable {
    /** @var array The to be used in the mustache template */
    protected $data = [];

    /**
     * Constructs a new instance of the backtocourse_menu_item class.
     *
     * @param string $title The title of the menu item.
     * @param string $url The URL for the menu item.
     * @param bool $active Whether the menu item is currently active.
     * @param bool $mobile Whether the menu item is for a mobile device.
     */
    public function __construct($title, $url, $active, $mobile = false) {
        $mycfg = get_config('local_extend_navigation');
        $this->data['title'] = $title;
        $this->data['url'] = $url;
        $this->data['active'] = $active;
        $this->data['mobile'] = $mobile;
        $this->data['icon'] = $mycfg->backtocourse_icon ?? '';
    }

    /**
     * Data for usage in mustache
     *
     * @param \renderer_base $output
     * @return array
     */
    public function export_for_template(\renderer_base $output) {
        return $this->data;
    }

}
