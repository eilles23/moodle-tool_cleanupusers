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
 * File to archive users.
 *
 * @package tool_deprovision
 * @copyright 2016 N Herrmann
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once('../../../config.php');
require_login();
require_once($CFG->dirroot.'/user/lib.php');

$userid         = required_param('userid', PARAM_INT);
$archived       = required_param('archived', PARAM_INT);

$PAGE->set_url('/admin/tool/deprovisionuser/archiveuser.php');
$PAGE->set_context(context_system::instance());

global $USER;
$user = $DB->get_record('user', array('id' => $userid));
require_capability('moodle/user:update', $PAGE->context);
if ($archived == 0) {
    if (!is_siteadmin($user) and $user->suspended != 1 and $USER->id != $userid) {
        $deprovisionuser = new \tool_deprovisionuser\archiveduser($userid, $user->suspended);
        $deprovisionuser->archive_me();
        notice(get_string('usersarchived', 'tool_deprovisionuser'),
            $CFG->wwwroot . '/admin/tool/deprovisionuser/index.php');
    } else {
        notice(get_string('errormessagenotsuspend', 'tool_deprovisionuser'), $CFG->wwwroot . '/admin/tool/deprovisionuser/index.php');
    }

} if ($archived == 1) {
    if (!is_siteadmin($user) and $user->suspended != 0 and $USER->id != $userid) {
        $deprovisionuser = new \tool_deprovisionuser\archiveduser($userid, $user->suspended);
        $deprovisionuser->activate_me();
        notice(get_string('usersactivated', 'tool_deprovisionuser'), $CFG->wwwroot . '/admin/tool/deprovisionuser/index.php');
    } else {
        notice(get_string('errormessagenotactive', 'tool_deprovisionuser'), $CFG->wwwroot . '/admin/tool/deprovisionuser/index.php');
    }
} else {
    notice(get_string('errormessagenoaction', 'tool_deprovisionuser'), $CFG->wwwroot . '/admin/tool/deprovisionuser/index.php');
}
exit();
