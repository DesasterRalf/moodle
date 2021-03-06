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
 * This script prints basic CSS for the installer
 *
 * @package    core
 * @subpackage install
 * @copyright  2011 Petr Skoda (http://skodak.org)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

if (file_exists(dirname(dirname(__FILE__)).'/config.php')) {
    // already installed
    die;
}

// include only the necessary stuff from themes, keep this small otherwise IE will complain...

// MDL-43839 IE9 cannot handle all of our css.
// Once IE9 is no longer supported we can include 'bootstrapbase/style/moodle.css'
// and remove some of the CSS in $content.
$files = array('');

$content = '';

foreach($files as $file) {
    $content .= file_get_contents(dirname(dirname(__FILE__)).'/theme/'.$file) . "\n";
}

$content .= "

body {
    padding: 4px;
}

.headermain {
    margin: 15px;
}

h2 {
  text-align:center;
}

input, textarea, .uneditable-input {
    width: 50%;
}

input[type=submit] {
    width: 30%;
}

#installdiv {
  width: 800px;
  margin-left:auto;
  margin-right:auto;
}

#installdiv dt {
  font-weight: bold;
}

#installdiv dd {
  padding-bottom: 0.5em;
}

.stage {
  margin-top: 2em;
  margin-bottom: 2em;
  width: 100%;
  padding:25px;
}

#installform {
  width: 100%;
}

#nav_buttons input {
  margin: 5px;
}

#envresult {
  text-align:left;
  width: auto;
  margin-left:10em;
}

#envresult dd {
  color: red;
}

.formrow {
  clear:both;
  text-align:left;
  padding: 8px;
}

.formrow label.formlabel {
  display:block;
  float:left;
  width: 160px;
  margin-right:5px;
  text-align:right;
}

.formrow .forminput {
  display:block;
  float:left;
}

fieldset {
  text-align:center;
  border:none;
}

.hint {
  display:block;
  clear:both;
  padding-left: 265px;
  color: red;
}

.configphp {
  text-align:left;
  background-color:white;
  padding:1em;
  width:95%;
}

.stage6 .stage {
  font-weight: bold;
  color: red;
}

/*
MDL-43839 IE9 cannot handle all of our CSS.
Once IE9 is no longer supported we can include 'bootstrapbase/style/moodle.css' above
and remove the following.
*/
body {
  font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
  font-size: 14px;
}
.breadcrumb {
  background-color: rgb(245, 245, 245);
  padding: 8px 15px;
}
/*
End of MDL-43839 IE9 specific CSS.
*/

";

// fix used urls
$content = str_replace('[[pix:theme|hgradient]]', '../theme/standard/pix/hgradient.jpg', $content);
$content = str_replace('[[pix:theme|vgradient]]', '../theme/standard/pix/vgradient.jpg', $content);

@header('Content-Disposition: inline; filename="css.php"');
@header('Cache-Control: no-store, no-cache, must-revalidate');
@header('Cache-Control: post-check=0, pre-check=0', false);
@header('Pragma: no-cache');
@header('Expires: Mon, 20 Aug 1969 09:23:00 GMT');
@header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
@header('Accept-Ranges: none');
@header('Content-Type: text/css; charset=utf-8');

echo $content;
