<?php
namespace Icecave\Skew\Entities\Processor;

use Icecave\Collections\Set;
use Phake;
use PHPUnit_Framework_TestCase;

class ProcessorStartMessageTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->message = new ProcessorStartMessage;
    }

    public function testInterfaces()
    {
        $this->assertInstanceOf('Icecave\Skew\Entities\MessageInterface', $this->message);
        $this->assertInstanceOf('Icecave\Skew\Entities\DaemonToClientMessageInterface', $this->message);
        $this->assertInstanceOf('Icecave\Skew\Entities\ProcessorMessageInterface', $this->message);

        $this->assertNotInstanceOf('Icecave\Skew\Entities\ClientMessageInterface', $this->message);
        $this->assertNotInstanceOf('Icecave\Skew\Entities\DaemonToProcessorMessageInterface', $this->message);
    }

    public function testType()
    {
        $this->assertSame('processor.start', $this->message->type());
    }

    /**
     * @covers Icecave\Skew\Entities\Processor\ProcessorTrait
     */
    public function testSetProcessor()
    {
        $this->message->setProcessor('def');
        $this->assertSame('def', $this->message->processor());
    }

    public function testSetCapabilities()
    {
        $this->assertEquals(new Set, $this->message->capabilities());
        $this->message->setCapabilities(['cap1', 'cap2']);
        $this->assertEquals(new Set(['cap1', 'cap2']), $this->message->capabilities());
    }

    public function testAccept()
    {
        $visitor = Phake::mock('Icecave\Skew\Entities\VisitorInterface');

        Phake::when($visitor)
            ->visitProcessorStartMessage($this->message)
            ->thenReturn(123);

        $this->assertSame(123, $this->message->accept($visitor));
    }
}
