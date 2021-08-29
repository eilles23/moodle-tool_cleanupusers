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
 * A scheduled task for tool_cleanupusers cron.
 *
 * The Class archive_user_task is supposed to show the admin a page of users which will be archived and expectes a submit or
 * cancel reaction.
 * @package    tool_cleanupusers
 * @copyright  2016 N Herrmann
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


namespace tool_cleanupusers\task;

defined('MOODLE_INTERNAL') || die();

use tool_cleanupusers\cleanupusers_exception;
// Needed for the default plugin.
use tool_cleanupusers\local\manager\subpluginmanager;
use tool_cleanupusers\transaction;
use tool_cleanupusers\useraction;
use tool_cleanupusers\usermanager;
use userstatus_userstatuswwu\userstatuswwu;
use tool_cleanupusers\archiveduser;
use tool_cleanupusers\event\deprovisionusercronjob_completed;
use core\task\scheduled_task;

class testable_archive_user_task extends archive_user_task {

    public function calculate_useractions($actionits, $delayits, $globaldelayit) {
        return parent::calculate_useractions($actionits, $delayits, $globaldelayit);
    }

    public function update_approve_db($selectedactions) {
        parent::update_approve_db($selectedactions);
    }

}
