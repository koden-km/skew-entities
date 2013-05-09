<?php
namespace Icecave\Skew\Entities\Messages\Processor;

use Icecave\Collections\Set;
use Icecave\Skew\Entities\Messages\ProcessorMessageInterface;
use Icecave\Skew\Entities\Messages\VisitorInterface;

class ProcessorStartMessage extends AbstractProcessorMessage implements ProcessorMessageInterface
{
    public function __construct()
    {
        $this->capabilities = new Set;
    }

    public function type()
    {
        return 'processor.start';
    }

    public function capabilities()
    {
        return $this->capabilities;
    }

    public function setCapabilities($capabilities)
    {
        $this->capabilities->clear();
        $this->capabilities->unionInPlace($capabilities);
    }

    public function accept(VisitorInterface $visitor)
    {
        return $visitor->visitProcessorStartMessage($this);
    }

    private $capabilities;
}
