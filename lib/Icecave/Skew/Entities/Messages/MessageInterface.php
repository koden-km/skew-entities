<?php
namespace Icecave\Skew\Entities\Messages;

interface MessageInterface
{
    public function type();

    public function accept(VisitorInterface $visitor);
}
