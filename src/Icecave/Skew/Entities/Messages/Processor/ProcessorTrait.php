<?php
namespace Icecave\Skew\Entities\Messages\Processor;

trait ProcessorTrait
{
    public function processor()
    {
        return $this->processor;
    }

    public function setProcessor($processor)
    {
        $this->processor = $processor;
    }

    private $processor;
}
