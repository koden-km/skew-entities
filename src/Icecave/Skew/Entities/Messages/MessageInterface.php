<?php
namespace Icecave\Skew\Entities\Messages;

interface MessageInterface
{
    /**
     * @return string
     */
    public function type();

    /**
     * @param VisitorInterface $visitor
     *
     * @return mixed
     */
    public function accept(VisitorInterface $visitor);
}
