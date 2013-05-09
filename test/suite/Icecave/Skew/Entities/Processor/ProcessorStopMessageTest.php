<?php
namespace Icecave\Skew\Entities\Processor;

use Phake;
use PHPUnit_Framework_TestCase;

class ProcessorStopMessageTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->message = new ProcessorStopMessage;
    }

    public function testInterfaces()
    {
        $this->assertInstanceOf('Icecave\Skew\Entities\MessageInterface', $this->message);
        $this->assertInstanceOf('Icecave\Skew\Entities\DaemonToClientMessageInterface', $this->message);
        $this->assertInstanceOf('Icecave\Skew\Entities\DaemonToProcessorMessageInterface', $this->message);

        $this->assertNotInstanceOf('Icecave\Skew\Entities\ProcessorMessageInterface', $this->message);
        $this->assertNotInstanceOf('Icecave\Skew\Entities\ClientMessageInterface', $this->message);
    }

    public function testType()
    {
        $this->assertSame('processor.stop', $this->message->type());
    }

    /**
     * @covers Icecave\Skew\Entities\Processor\ProcessorTrait
     */
    public function testSetProcessor()
    {
        $this->message->setProcessor('def');
        $this->assertSame('def', $this->message->processor());
    }

    public function testAccept()
    {
        $visitor = Phake::mock('Icecave\Skew\Entities\VisitorInterface');

        Phake::when($visitor)
            ->visitProcessorStopMessage($this->message)
            ->thenReturn(123);

        $this->assertSame(123, $this->message->accept($visitor));
    }
}
