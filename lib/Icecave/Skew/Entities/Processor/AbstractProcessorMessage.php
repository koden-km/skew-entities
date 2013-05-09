<?php
namespace Icecave\Skew\Entities\Processor;

use Icecave\Skew\Entities\DaemonToClientMessageInterface;

abstract class AbstractProcessorMessage implements DaemonToClientMessageInterface
{
    use ProcessorTrait;
}
