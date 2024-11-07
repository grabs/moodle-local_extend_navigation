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
    /** The left border of the menu item. */
    public const BORDER_LEFT = '1';
    /** The right border of the menu item. */
    public const BORDER_RIGHT = '2';
    /** The left and right border of the menu item. */
    public const BORDER_LEFT_RIGHT = '3';
    /** No border of the menu item. */
    public const BORDER_NONE = '0';

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
        $this->data['border'] = $this->get_border_class();
    }

    /**
     * Returns the CSS class for the border of the "Back to Course" menu item based on the configuration.
     *
     * @return string The CSS class for the border.
     */
    protected function get_border_class() {
        $mycfg = get_config('local_extend_navigation');
        switch ($mycfg->backtocourse_border) {
            case self::BORDER_LEFT:
                return 'border-left';
            case self::BORDER_RIGHT:
                return 'border-right';
            case self::BORDER_LEFT_RIGHT:
                return 'border-left border-right';
            case self::BORDER_NONE:
                return 'border-0';
        }
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
