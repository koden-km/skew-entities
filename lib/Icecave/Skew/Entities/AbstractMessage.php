<?php
namespace Icecave\Skew\Entities;

abstract class AbstractMessage
{
    public abstract function type();

    public abstract function accept(VisitorInterface $visitor)
    {
        $method = 'visit' . get_class($this);
        return $visitor->{$method}($this);
    }
}
