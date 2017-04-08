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

    //vytvoríme kartu general settings
    $page = new admin_settingpage('theme_modernc_general', get_string('generaltitle', 'theme_modernc'));

    //vyber farebnej schemy (dark, light)

    //obrázok pozadia
    $name = 'theme_modernc/backgroundimage';
    $title = get_string('backgroundimage', 'theme_modernc');
    $description = get_string('backgroundimage_desc', 'theme_modernc');
    $setting = new admin_setting_configstoredfile($name, $title, $description, 'backgroundimage');
    $setting->set_updatedcallback('theme_modernc_update_settings_images');
    $page->add($setting);

    //zmena farby pozadia
    $name = 'theme_modernc/backgroundcolor';
    $title = get_string('backgroundcolor', 'theme_modernc');
    $description = get_string('backgroundcolor_desc', 'theme_modernc');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    //pisanie css priamo v administracii
    $name = 'theme_modernc/customcss';
    $title = get_string('customcss', 'theme_modernc');
    $description = get_string('customcss_desc', 'theme_modernc');
    $setting = new admin_setting_configtextarea($name, $title, $description, '', PARAM_RAW);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    //kartu pridáme do nastavení
    $settings->add($page);

    //vytvoríme kartu color and font settings
    $page = new admin_settingpage('theme_modernc_colorfont', get_string('colorfonttitle', 'theme_modernc'));

    //nastavenia pisma nadpisov
    $name = 'theme_modernc/font_family_title';
    $title = get_string('font-family-title','theme_modernc');
    $description = get_string('font-family-title_desc', 'theme_modernc');
    $choices = [
        'OpenSans'      => 'Open Sans',
        'Lato'          => 'Lato',
        'Roboto'        => 'Roboto',
        'SourceSansPro' => 'Source Sans Pro',
    ];
    $default = 'OpenSans';
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    //nastavenia pisma textu
    $name = 'theme_modernc/font_family_text';
    $title = get_string('font-family-text','theme_modernc');
    $description = get_string('font-family-text_desc', 'theme_modernc');
    $choices = [
        'OpenSans'      => 'Open Sans',
        'Lato'          => 'Lato',
        'Roboto'        => 'Roboto',
        'SourceSansPro' => 'Source Sans Pro',
    ];
    $default = 'OpenSans';
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    //nastavenie hlavnej farby
    $name = 'theme_modernc/brandprimary';
    $title = get_string('brandprimary', 'theme_modernc');
    $description = get_string('brandprimary_desc', 'theme_modernc');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    //nastavenie hlavnej farby
    $name = 'theme_modernc/brandsuccess';
    $title = get_string('brandsuccess', 'theme_modernc');
    $description = get_string('brandsuccess_desc', 'theme_modernc');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    //nastavenie hlavnej farby
    $name = 'theme_modernc/brandwarning';
    $title = get_string('brandwarning', 'theme_modernc');
    $description = get_string('brandwarning_desc', 'theme_modernc');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    //nastavenie hlavnej farby
    $name = 'theme_modernc/branddanger';
    $title = get_string('branddanger', 'theme_modernc');
    $description = get_string('branddanger_desc', 'theme_modernc');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    //nastavenie farby pozadia left sidebar
    $name = 'theme_modernc/sidebar_bg_color';
    $title = get_string('sidebar-bg-color', 'theme_modernc');
    $description = get_string('sidebar-bg-color_desc', 'theme_modernc');
    $setting = new admin_setting_configcolourpicker($name, $title, $description, '');
    $setting->set_updatedcallback('theme_reset_all_caches');
    $page->add($setting);

    //kartu pridáme do nastavení
    $settings->add($page);


    //vytvoríme kartu slider settings
    $page = new admin_settingpage('theme_modernc_slider', get_string('slidertitle', 'theme_modernc'));

    //pridanie nastavenia do karty
    //$page->add($setting);

    //kartu pridáme do nastavení
    $settings->add($page);

}
