<?php
namespace Icecave\Skew\Entities\Job;

use Eloquent\Enumeration\Enumeration;

class LogLevel extends Enumeration
{
    const EMERGENCY = "emerg";
    const ALERT = "alert";
    const CRITICAL = "crit";
    const ERROR = "err";
    const WARNING = "warning";
    const NOTICE = "notice";
    const INFO = "info";
    const DEBUG = "debug";
}
