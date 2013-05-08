<?php
namespace Icecave\Skew\Entities\Job;

use Icecave\Skew\Entities\Worker\WorkerTrait;

class AbstractJobMessageWithWorker extends AbstractJobMessage
{
    use WorkerTrait;
}
