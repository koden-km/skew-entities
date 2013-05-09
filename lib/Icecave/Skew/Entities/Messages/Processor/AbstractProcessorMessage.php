<?php
namespace Icecave\Skew\Entities\Messages\Processor;

use Icecave\Skew\Entities\Messages\DaemonToClientMessageInterface;

abstract class AbstractProcessorMessage implements DaemonToClientMessageInterface
{
    use ProcessorTrait;
}
