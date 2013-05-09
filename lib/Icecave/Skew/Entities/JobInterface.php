<?php
namespace Icecave\Skew\Entities;

use Icecave\Collections\Set;

interface JobInterface
{
    /**
     * @return string
     */
    public function id();

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
