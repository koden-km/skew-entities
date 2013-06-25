<?php
namespace Icecave\Skew\Entities;

use Icecave\Collections\Set;

interface TaskDetailsInterface
{
    /**
     * @return Priority
     */
    public function priority();

    /**
     * @return string
     */
    public function task();

    /**
     * @return mixed
     */
    public function payload();

    /**
     * @return Set<string>
     */
    public function tags();
}
