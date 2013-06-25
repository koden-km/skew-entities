<?php
namespace Icecave\Skew\Entities\Messages\Serialization;

use Icecave\Skew\Entities\Messages\MessageInterface;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;

class Serializer
{
    public function __construct()
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->visitor = new SerializerVisitor;
    }

    /**
     * @param MessageInterface $message
     *
     * @return string
     */
    public function serialize(MessageInterface $message)
    {
        $this->typeCheck->serialize(func_get_args());

        $object = $message->accept($this->visitor);

        return json_encode($object);
    }

    private $typeCheck;
    private $visitor;
}
