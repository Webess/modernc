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
