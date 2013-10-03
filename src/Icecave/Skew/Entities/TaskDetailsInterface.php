<?php
namespace Icecave\Skew\Entities;

use Icecave\Collections\Set;

interface TaskDetailsInterface
{
    /**
     * @return string
     */
    public function task();

    /**
     * @return Priority
     */
    public function priority();

    /**
     * @return mixed
     */
    public function payload();

    /**
     * @return Set<string>
     */
    public function tags();
}
