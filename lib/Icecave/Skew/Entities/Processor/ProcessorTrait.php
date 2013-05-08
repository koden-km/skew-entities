<?php
namespace Icecave\Skew\Entities\Processor;

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
