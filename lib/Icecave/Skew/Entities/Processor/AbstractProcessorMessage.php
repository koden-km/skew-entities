<?php
namespace Icecave\Skew\Entities\Processor;

use Icecave\Skew\Entities\MessageInterface;

class AbstractProcessorMessage implements DaemonToClientMessageInterface
{
    use ProcessorTrait;
}
