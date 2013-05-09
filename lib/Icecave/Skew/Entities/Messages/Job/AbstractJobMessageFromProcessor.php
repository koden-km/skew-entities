<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Skew\Entities\Messages\DaemonToClientMessageInterface;
use Icecave\Skew\Entities\Messages\Processor\ProcessorTrait;
use Icecave\Skew\Entities\Messages\ProcessorMessageInterface;

abstract class AbstractJobMessageFromProcessor extends AbstractJobMessage implements DaemonToClientMessageInterface, ProcessorMessageInterface
{
    use ProcessorTrait;
}
