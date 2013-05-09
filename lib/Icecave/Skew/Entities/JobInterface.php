<?php
namespace Icecave\Skew\Entities;

interface JobInterface
{
    /**
     * @return string
     */
    public function id();

    /**
     * @return TaskDetailsInterface
     */
    public function taskDetails();
}
