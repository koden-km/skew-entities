<?php
namespace Icecave\Skew\Entities\Messages\Job;

use Icecave\Skew\Entities\Messages\Flow\DaemonToClientMessageInterface;
use Icecave\Skew\Entities\Messages\Flow\ProcessorMessageInterface;
use Icecave\Skew\Entities\Messages\Processor\ProcessorAwareMessageInterface;
use Icecave\Skew\Entities\Messages\Processor\ProcessorTrait;

abstract class AbstractJobMessageFromProcessor extends AbstractJobMessage implements
    ProcessorAwareMessageInterface,
    ProcessorMessageInterface,
    DaemonToClientMessageInterface
{
    use ProcessorTrait;
}
