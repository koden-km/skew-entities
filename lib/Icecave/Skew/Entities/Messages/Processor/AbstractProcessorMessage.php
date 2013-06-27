<?php
namespace Icecave\Skew\Entities\Messages\Processor;

use Icecave\Skew\Entities\Messages\Flow\DaemonToClientMessageInterface;

abstract class AbstractProcessorMessage implements ProcessorAwareMessageInterface, DaemonToClientMessageInterface
{
    use ProcessorTrait;
}
