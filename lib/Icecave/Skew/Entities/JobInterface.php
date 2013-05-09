<?php
namespace Icecave\Skew\Entities;

interface JobInterface extends JobDetailsInterface
{
    /**
     * @return string
     */
    public function id();
}
