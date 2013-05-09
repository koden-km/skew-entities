<?php
namespace Icecave\Skew\Entities\TypeCheck;

class DummyValidator extends AbstractValidator
{
    public function __call($name, array $arguments)
    {
    }

}
