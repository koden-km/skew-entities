<?php
namespace Icecave\Skew\Entities;

interface MessageInterface
{
    public function type();

    public function accept(VisitorInterface $visitor);
}
