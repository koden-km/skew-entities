<?php
namespace Icecave\Skew\Entities\Job;

use Icecave\Skew\Entities\Processor\ProcessorTrait;

class AbstractJobMessageFromProcessor extends AbstractJobMessage implements DaemonToClientMessageInterface, ProcessorMessageInterface
{
    use ProcessorTrait;
}
