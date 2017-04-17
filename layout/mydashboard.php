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

defined('MOODLE_INTERNAL') || die();

user_preference_allow_ajax_update('drawer-open-nav', PARAM_ALPHA);
require_once($CFG->libdir . '/behat/lib.php');

if (isloggedin()) {
    $navdraweropen = (get_user_preferences('drawer-open-nav', 'true') == 'true');
} else {
    $navdraweropen = false;
}
$extraclasses = [];
if ($navdraweropen) {
    $extraclasses[] = 'drawer-open-left';
}
$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$blockshtml = $OUTPUT->blocks('side-pre');
$hasblocks = strpos($blockshtml, 'data-block=') !== false;
$regionmainsettingsmenu = $OUTPUT->region_main_settings_menu();
$templatecontext = [
    'sitename'                  => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output'                    => $OUTPUT,
    'sidepreblocks'             => $blockshtml,
    'hasblocks'                 => $hasblocks,
    'bodyattributes'            => $bodyattributes,
    'navdraweropen'             => $navdraweropen,
    'regionmainsettingsmenu'    => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    //carousel
    'carouselshow'              => $PAGE->theme->settings->carouselshow,
    'carousel1title'            => '<h2>'.$PAGE->theme->settings->carousel1title.'</h2>',
    'carousel1text'             => '<p>'.$PAGE->theme->settings->carousel1text.'</p>',
    'carousel2title'            => '<h2>'.$PAGE->theme->settings->carousel2title.'</h2>',
    'carousel2text'             => '<p>'.$PAGE->theme->settings->carousel2text.'</p>',
    'carousel3title'            => '<h2>'.$PAGE->theme->settings->carousel3title.'</h2>',
    'carousel3text'             => '<p>'.$PAGE->theme->settings->carousel3text.'</p>',
    //panels
    'panelshow'                 => $PAGE->theme->settings->panelshow,
    'panel1title'               => '<h3 class="card-title">'.$PAGE->theme->settings->panel1title.'</h3>',
    'panel1html'                => format_text($PAGE->theme->settings->panel1html),
    'panel2title'               => '<h3 class="card-title">'.$PAGE->theme->settings->panel2title.'</h3>',
    'panel2html'                => format_text($PAGE->theme->settings->panel2html),
    'panel3title'               => '<h3 class="card-title">'.$PAGE->theme->settings->panel3title.'</h3>',
    'panel3html'                => format_text($PAGE->theme->settings->panel3html),
    'panel4title'               => '<h3 class="card-title">'.$PAGE->theme->settings->panel4title.'</h3>',
    'panel4html'                => format_text($PAGE->theme->settings->panel4html),
];

$templatecontext['flatnavigation'] = $PAGE->flatnav;
echo $OUTPUT->render_from_template('theme_modernc/mydashboard', $templatecontext);
