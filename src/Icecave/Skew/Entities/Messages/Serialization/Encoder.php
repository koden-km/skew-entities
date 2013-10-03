<?php
namespace Icecave\Skew\Entities\Messages\Serialization;

use Icecave\Skew\Entities\Messages\MessageInterface;
use Icecave\Skew\Entities\TypeCheck\TypeCheck;
use stdClass;

class Encoder
{
    public function __construct()
    {
        $this->typeCheck = TypeCheck::get(__CLASS__, func_get_args());

        $this->visitor = new EncoderVisitor;
    }

    /**
     * @return Encoder
     */
    public static function instance()
    {
        TypeCheck::get(__CLASS__)->instance(func_get_args());

        if (null === self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @param MessageInterface $message
     *
     * @return stdClass
     */
    public function encode(MessageInterface $message)
    {
        $this->typeCheck->encode(func_get_args());

        return $message->accept($this->visitor);
    }

    private static $instance;
    private $typeCheck;
    private $visitor;
}
