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
 * Add page to admin menu.
 *
 * @package    local_extend_navigation
 * @author Andreas Grabs <moodle@grabs-edv.de>
 * @copyright  Andreas Grabs
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {
    $pluginname = get_string('pluginname', 'local_extend_navigation');

    $settings = new admin_settingpage('local_extend_navigation_settings', $pluginname);
    $ADMIN->add('localplugins', $settings);

    $configs = [];

    $configs[] = new admin_setting_configselect(
        'backtocourse_active',
        get_string('active'),
        '',
        1,
        [0 => get_string('no'), 1 => get_string('yes')]
    );

    $configs[] = new admin_setting_configtext(
        'backtocourse_icon',
        get_string('backtocourse_icon', 'local_extend_navigation'),
        get_string('backtocourse_icon_help', 'local_extend_navigation'),
        'arrow-left',
        PARAM_NOTAGS
    );

    $options = [
        '0' => get_string('border_none', 'local_extend_navigation'),
        '1' => get_string('border_left', 'local_extend_navigation'),
        '2' => get_string('border_right', 'local_extend_navigation'),
        '3' => get_string('border_left_right', 'local_extend_navigation'),
    ];
    $configs[] = new admin_setting_configselect(
        'backtocourse_border',
        get_string('border', 'local_extend_navigation'),
        '',
        \local_extend_navigation\output\components\backtocourse_menu_item::BORDER_NONE,
        $options
    );

    // Put all settings into the settings page.
    foreach ($configs as $config) {
        $config->plugin = 'local_extend_navigation';
        $settings->add($config);
    }
}
