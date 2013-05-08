<?php
namespace Icecave\Skew\Entities\Worker;

use Icecave\Skew\Entities\AbstractMessage;

class AbstractWorkerMessage extends AbstractMessage
{
    use WorkerTrait;
}
