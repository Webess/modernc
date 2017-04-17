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

//nacitanie SCSS
function theme_modernc_get_main_scss($theme) {
    global $CFG;

    //načítanie default.scss z rodičovskej témy
    $scss = file_get_contents($CFG->dirroot . '/theme/boost/scss/preset/default.scss');
    //načítanie nášho pre.scss
    $pre  = file_get_contents($CFG->dirroot . '/theme/modernc/scss/pre.scss');
    //načítanie nášho post.scss
    $post = file_get_contents($CFG->dirroot . '/theme/modernc/scss/post.scss');

    //skombinovanie súborov
    return $pre . "\n" . $scss . "\n" . $post;
}

//nacitanie nasich premennych z administracie
function theme_modernc_get_pre_scss($theme) {
    global $CFG;

    $prescss = '';

    $configurable = [
        // kľúč v administrácií => názov premennej
        'backgroundcolor' => 'backgroundcolor',
        'fontfamilytitle' => 'font-family-title',
        'fontfamilytext'  => 'font-family-text',
        'brandprimary'    => 'brand-primary',
        'brandsuccess'    => 'brand-success',
        'brandwarning'    => 'brand-warning',
        'branddanger'     => 'brand-danger',
        'carouselheight'  => 'carousel-height',
    ];

    // spracovanie poľa $configurable na premenné
    foreach ($configurable as $configkey => $targets) {
        $value = $theme->settings->{$configkey};
        if (empty($value)) continue;
        array_map(function($target) use (&$prescss, $value) {
            $prescss .= '$' . $target . ': ' . $value . ";\n";
        }, (array) $targets);
    }

    return $prescss;
}

//upload a spracovanie obrazkov temy
function theme_modernc_update_settings_images($settingname) {
    global $CFG;

    // The setting name that was updated comes as a string like 's_theme_photo_loginbackgroundimage'.
    // We split it on '_' characters.
    $parts = explode('_', $settingname);
    // And get the last one to get the setting name..
    $settingname = end($parts);

    // Admin settings are stored in system context.
    $syscontext = context_system::instance();
    // This is the component name the setting is stored in.
    $component = 'theme_modernc';

    // This is the value of the admin setting which is the filename of the uploaded file.
    $filename = get_config($component, $settingname);
    // We extract the file extension because we want to preserve it.
    $extension = substr($filename, strrpos($filename, '.') + 1);

    // This is the path in the moodle internal file system.
    $fullpath = "/{$syscontext->id}/{$component}/{$settingname}/0{$filename}";
    // Get an instance of the moodle file storage.
    $fs = get_file_storage();
    // This is an efficient way to get a file if we know the exact path.
    if ($file = $fs->get_file_by_hash(sha1($fullpath))) {
        // We got the stored file - copy it to dataroot.
        // This location matches the searched for location in theme_config::resolve_image_location.
        $pathname = $CFG->dataroot . '/pix_plugins/theme/modernc/' . $settingname . '.' . $extension;

        // This pattern matches any previous files with maybe different file extensions.
        $pathpattern = $CFG->dataroot . '/pix_plugins/theme/modernc/' . $settingname . '.*';

        // Make sure this dir exists.
        @mkdir($CFG->dataroot . '/pix_plugins/theme/modernc/', $CFG->directorypermissions, true);

        // Delete any existing files for this setting.
        foreach (glob($pathpattern) as $filename) {
            @unlink($filename);
        }

        // Copy the current file to this location.
        $file->copy_content_to($pathname);
    }

    // Reset theme caches.
    theme_reset_all_caches();
}

//spracovanie vlastneho css
function theme_modernc_process_css($css, $theme) {
    $customcss = $theme->settings->customcss;
    $tag = '[[theme:customcss]]';
    if (is_null($customcss)) $customcss = '';
    $css = str_replace($tag, $customcss, $css);
    return $css;
}
