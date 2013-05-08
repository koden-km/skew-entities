<?php
namespace Icecave\Skew\Entities\Worker;

trait WorkerTrait
{
    public function worker()
    {
        return $this->worker;
    }

    public function setWorker($worker)
    {
        $this->worker = $worker;
    }

    private $worker;
}
