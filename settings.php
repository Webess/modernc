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

// This line protects the file from being accessed by a URL directly.
defined('MOODLE_INTERNAL') || die();

//nastavenie témy sa zobrazí iba v administrácií
if ($ADMIN->fulltree) {

    //do administrácie pridáme stránku nastavenia témy
    $settings = new theme_boost_admin_settingspage_tabs('themesettingmodernc', get_string('settingstitle', 'theme_modernc'));

    //vytvoríme kartu
    $page = new admin_settingpage('theme_modernc_general', get_string('generaltitle', 'theme_modernc'));

    //pridanie nastavenia do karty
    //$page->add($setting);

    //kartu pridáme do nastavení
    $settings->add($page);
}
