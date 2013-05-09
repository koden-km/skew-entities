<?php
namespace Icecave\Skew\Entities\Job;

use Icecave\Skew\Entities\DaemonToClientMessageInterface;
use Icecave\Skew\Entities\Processor\ProcessorTrait;
use Icecave\Skew\Entities\ProcessorMessageInterface;

abstract class AbstractJobMessageFromProcessor extends AbstractJobMessage implements DaemonToClientMessageInterface, ProcessorMessageInterface
{
    use ProcessorTrait;
}
