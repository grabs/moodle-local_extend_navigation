// Standard license block omitted.
/**
 * @module     local_extend_navigation/schooladmin_menu
 * @copyright  2022 Grabs-EDV
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import Fragment from 'core/fragment';
import Templates from 'core/templates';
import Notification from 'core/notification';

export const init = (title, url, contextid, active) => {
    var mormenuselector = '#page-wrapper .navbar .primary-navigation .moremenu.navigation .navbar-nav';
    var moremenubuttonselector = mormenuselector + ' .dropdownmoremenu';

    var moremenu = document.querySelector(mormenuselector);
    if (moremenu === null) {
        return;
    }
    var drawerid = 'theme_boost-drawers-primary';

    var mobilemenu = document.querySelector('#' + drawerid + ' div.drawercontent div.list-group');

    var moremenuid = moremenu.getAttribute('id');
    if (moremenuid === null) {
        return;
    }

    var fragmentcall = 'get_html';
    var serviceparams1 = {
        "function": 'get_backtocourse_moremenu_item',
        "title": title,
        "url": url,
        "active": active,
    };

    var fragmentpromise1 = Fragment.loadFragment('local_extend_navigation', fragmentcall, contextid, serviceparams1);
    fragmentpromise1.then(function(html, js) {
        var menuepartiallyhidden = !document.querySelector(moremenubuttonselector).classList.contains('d-none');
        let backtocoursenode;
        if (menuepartiallyhidden) {
            // Moremenue partially hidden.
            // So we have to insert the item into the hidden moremenue.
            var hiddenmoremenu = document.querySelector(moremenubuttonselector + ' ul.dropdown-menu');
            hiddenmoremenu.insertAdjacentHTML('beforeend', html);
            backtocoursenode = document.querySelector('.backtocoursenode');
            backtocoursenode.classList.remove('nav-link');
            backtocoursenode.classList.add('dropdown-item');
        } else {
            moremenu.insertAdjacentHTML('beforeend', html);
            backtocoursenode = document.querySelector('.backtocoursenode');
            backtocoursenode.classList.add('nav-link');
            backtocoursenode.classList.remove('dropdown-item');
        }
        if (js) {
            Templates.runTemplateJS(js);
        }
        return true;
    }).fail(Notification.exception);

    var serviceparams2 = {
        "function": 'get_backtocourse_mobilemenu_item',
        "title": title,
        "url": url,
        "active": active,
    };

    var fragmentpromise2 = Fragment.loadFragment('local_extend_navigation', fragmentcall, contextid, serviceparams2);
    fragmentpromise2.then(function(html, js) {
        mobilemenu.insertAdjacentHTML('beforeend', html);
        if (js) {
            Templates.runTemplateJS(js);
        }
        return true;
    }).fail(Notification.exception);

};
